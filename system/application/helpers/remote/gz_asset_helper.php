<?php
/**
* ----------------------------------------------------------------------------
*
* The Software shall be used for Good, not Evil... bad eval()!
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*
* ----------------------------------------------------------------------------
/**
 * Compress_assets
 *
 *
 * @access		private
 * @category	Helpers
 * @author		Donn Hill
 * @link		http://codeigniter.com/user_guide/helpers/
 */
//	To do
//	Add passing of multiple assets/combining eg. multiple js to one js.gz etc...

class Krunch{

//set variables
	var $debug = FALSE;
	var $headers = array();
	var $target_file = array();
	var $sysValues = array();
	var $set =  array(
		'VERSION' => '0.75',
		'path2assets' => APPPATH, 
		'asset_exp' => 25920000,
		'uri' => '',
		);
	var $asset_types = array(
		"htm"  => "text/html",
		"html" => "text/html",
		"js"   => "text/javascript",
		"css"  => "text/css",
		"xml"  => "text/xml",
		"gif"  => "image/gif",
		"jpg"  => "image/jpeg",
		"jpeg" => "image/jpeg",
		"png"  => "image/png",
		"txt"  => "text/plain"		
		);	
	var $assets_folder = array(
		'js'=>'assets/js/',
		'css'=>'assets/css/',
		'gif'=>'assets/images/',
		'jpg'=>'assets/images/',
		'jpeg'=>'assets/images/',
		'png'=>'assets/images/'
		 );
	// after document root e.g.
	// IF:   home/www/directory/my_application/cache_folder
	// THEN:          directory/my_application/cache_folder 
	var $cache_folder = array(
        'js'=>'system/cache/',
        'css'=>'system/cache/',
        'gif'=>'system/cache/',
        'jpg'=>'system/cache/',
        'jpeg'=>'system/cache/',
        'png'=>'system/cache/',
        'swf'=>'system/cache/'    
    );  
		 

		 
		 
			function krunch()
			{

				$this->set['uri'] = $_SERVER['REQUEST_URI'];
				$this->check_file();
				$this->initialize();

			}
			
			function check_file()
			{
				$this->target_file = pathinfo( $this->set['uri']);
				
				// @ used to suppress errors. is_real = '' will stop the script
				$this->target_file['dirname'] =	@$this->assets_folder[ $this->target_file['extension'] ];//rewrite dirname
				
				$this->target_file['fullpath'] = @$this->set['path2assets'] .$this->target_file['dirname']. $this->target_file['basename'] ;
				
				$this->target_file['is_real'] = @file_exists( $this->target_file['fullpath'] );	

			}//EOF
						
			function initialize()
			{
			
			$this->_check_writable();
	
				//if file exists and cache folder is writable
				if( $this->target_file['is_real'] == TRUE && $this->sysValues['cache_writable'] == TRUE )
				{
	
					$this->_get_settings();
									
					$this->_get_target_type();

					$this->set_caching();
					
					$this->output();
				
				}else{

					header( 'HTTP/1.1 404 Not Found' );	
					
					if($this->target_file['is_real'] == FALSE)
					{
						
						echo "<H3>file ".$this->target_file['basename']." with extension ".$this->target_file['extension']." was not found</H3>";	
									
						
					}elseif($this->sysValues['cache_writable'] == FALSE)
					{
					
						echo "<H3>The cache folder is not writable. Sorry!</H3>";	
					
					}
					
					exit;					
	
				}	
	
			}//EOF
			
			function _check_writable()
			{
			
				$this->sysValues['cache_folder'] = $_SERVER['DOCUMENT_ROOT'].'/'.$this->cache_folder[ $this->target_file['extension'] ];
				
				$this->sysValues['cache_writable'] = is_writable( $this->sysValues['cache_folder'] );

				// Check if windows because windows does not support chmod(cache_folder, 0777)
				$this->sysValues['OS'] = strtoupper( substr( PHP_OS, 0, 3 ) );
							
							
				if(! $this->sysValues['cache_writable'] && $this->sysValues['OS'] !== 'WIN' )
				{
				
					$this->sysValues['cache_writable'] = @chmod($this->sysValues['cache_folder'], 0777);
				
				}				
			
			
			}

			function _get_settings()
			{
			
				$this->sysValues['gzip'] = extension_loaded('zlib');
				
				$this->sysValues['gzip'] = isset($_SERVER['HTTP_ACCEPT_ENCODING']);
				
				$this->sysValues['gzip'] = ( strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE )? TRUE: FALSE;
				
				$this->sysValues['gzip_target'] = $this->sysValues['cache_folder'] . $this->target_file['basename'].'.gz';
				
				$this->sysValues['gzip'] = file_exists( $this->sysValues['gzip_target'] );

				if($this->sysValues['gzip'])
				{
					$this->sysValues['new'] = ( filemtime($this->target_file['fullpath']) >  filemtime($this->sysValues['gzip_target']) )? TRUE : FALSE;
				
					if($this->sysValues['new'])
					{ 
						
						unlink( $this->sysValues['gzip_target'] );
						
						$this->sysValues['gzip'] = FALSE; //cause I deleted it
					
					}else{
					
						return FALSE;
					
					}
				}
			
			}
			
			
			function set_caching()		
			{
				$age = $this->set['asset_exp'];
			
				$file_used_last = filemtime( $this->target_file['fullpath'] );
				
				$this->headers['headers'][]= "Last-Modified: " . date( "r", $file_used_last );

				$this->headers['headers'][] = "Expires: " . date( "r", ( $age + $file_used_last ) );
				
				$this->headers['headers'][] = "ETag: " .  dechex($file_used_last);
				
				$this->headers['headers'][] = "Cache-Control: " .  "public, must-revalidate, proxy-revalidate, max-age=" . $age . ", s-maxage=" . $age;	
				
				$this->headers['headers'][] = "Content-Type: " . $this->asset_types[ $this->target_file['extension'] ];	
								
				$this->headers['headers'][] = "Content-Length: " . filesize( $this->target_file['fullpath'] ) ;	
					
			}//EOF set_caching


		function output()
		{
			if($this->debug)
			{		
				echo "<pre>";
					print_r($this->_debugger());
				echo "</pre>";
				exit;
				
			}elseif(!$this->debug){
			
				ob_start();
			
				foreach( $this->headers['headers'] as $headers)
				{
					header( $headers );
					
				}
			
				readfile($this->target_file['fullpath']);
				
				ob_end_flush();
				exit;
			}		
						
		
		}//EOF output
		
// Private method _get_target_type
		function _get_target_type()
		{
		
			if($this->sysValues['gzip'])//gzip version found
			{
				$this->target_file['modify'] = filemtime( $this->sysValues['gzip_target'] );
								
				$this->headers['headers'][] = "Content-Encoding: gzip";
				
				$this->target_file['fullpath'] = $this->sysValues['gzip_target'];									

			}elseif(!$this->sysValues['gzip'])//gzip version NOT found
					{	

						$this->_compressor( $this->target_file['fullpath'], $this->sysValues['gzip_target'] );
						
						$this->target_file['modify'] = filemtime( $this->sysValues['gzip_target'] );
								
						$this->headers['headers'][] = "Content-Encoding: gzip";						
						
						$this->target_file['fullpath'] = $this->sysValues['gzip_target'];
						
					}
							
		}//EOF

	
// Private method _compressor
		function _compressor( $srcFileName, $dstFileName )
		{
		   if(strlen($srcFileName) >= 1000)
		   {	
		   		//too small to gzip
				return;
			}else{   	
					if ( $file_out = gzopen( $dstFileName, "wb" ) ) {
						if ( $file_in = fopen( $srcFileName, "rb" ) ) {
							while( !feof( $file_in ) )
								gzwrite( $file_out, fread( $file_in, 1024*512 ) );
							fclose( $file_in );			
							}
						}
					}
		}	
		
// Private method _uncompressor	
		// This method is note being used... maybe later at some stage!	
		function _uncompressor( $srcFileName, $dstFileName, $fileSize )
		{
			// getting content of the compressed file
			$zp = gzopen( $srcFileName, "r" );
			$data = fread ( $zp, $fileSize );
			gzclose( $zp );
			
			// writing uncompressed file
			$fp = fopen( $dstFileName, "w" );
			fwrite( $fp, $data );
			fclose( $fp );
		}	

// Private method _debug
		function _debugger( $temp=array() )
		{
		
			$temp['sysValues'] = $this->sysValues;
			
			$temp['cache_folder'] = $this->cache_folder;
	
			$temp['set'] = $this->set;
			
			$temp['Headers'] = $this->headers;
		
			$temp['target_file'] = $this->target_file;
				
			$temp['assest_types'] = $this->asset_types;

			$temp['assets_folder'] = $this->assets_folder;
			
			return $temp;
			
		}
			
}//end Krunch



?>