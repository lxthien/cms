<div class="exchange">
	<div class="whole_container">
		<p>&nbsp;</p>
		<div class="aboutus_l fl">
			<div id="cse" style="width: 100%;">Loading</div>
            <script src="http://www.google.com/jsapi" type="text/javascript"></script>
            <script type="text/javascript"> 
              google.load('search', '1', {language : 'en', style : google.loader.themes.V2_DEFAULT});
              google.setOnLoadCallback(function() {
                var customSearchOptions = {};  var customSearchControl = new google.search.CustomSearchControl(
                  '008357568275208203574:pivru5rww2e', customSearchOptions);
                customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
                customSearchControl.draw('cse');
                function parseParamsFromUrl() {
                  var params = {};
                  var parts = window.location.search.substr(1).split('\x26');
                  for (var i = 0; i < parts.length; i++) {
                    var keyValuePair = parts[i].split('=');
                    var key = decodeURIComponent(keyValuePair[0]);
                    params[key] = keyValuePair[1] ?
                        decodeURIComponent(keyValuePair[1].replace(/\+/g, ' ')) :
                        keyValuePair[1];
                  }
                  return params;
                }
            
                var urlParams = parseParamsFromUrl();
                var queryParamName = "q";
                if (urlParams[queryParamName]) {
                  customSearchControl.execute(urlParams[queryParamName]);
                }
              }, true);
            </script>
        </div>
        <?php $this->load->view('front/includes/r_about_us') ?>
		<div class="clr"></div>
	</div>
</div>
<style type="text/css">
    .gsc-search-button {
        display: none;
    }
</style>