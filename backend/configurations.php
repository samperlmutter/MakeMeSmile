<?php
$latest_version = 3.0;
?>
<!DOCTYPE html>
<link rel="shortcut icon" href="images/favicon.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="css/configurations.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    var defaults = {
        temperature_scale: 't-celsius',
        bluetooth: 'on_disconnect'
    };
</script>

<div class="main">
    <?php
    if (!isset($_GET['version']) || $_GET['version'] < $latest_version) :
    ?>
        <div class="notice">
            The new version is available. Please re-install this watchface from the Pebble App Store.
        </div>
    <?php
    endif;
    ?>
    <div class="donate-container">
        Your donation will motivate me to create a new watchfaces and support this one. Feel free to
    </div>

    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="XAZLE7DVLU5RE">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" id="donate-btn" alt="PayPal">
        <img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
    </form>

    <div tabindex="-1" class="sweet-overlay"></div>
    <div class="loader">Loading...</div>

    <div class="geolocation-container">
        <div class="page-header"><h3>Custom location</h3></div>

        <label for="geolocation">Enter city name. If field is empty will be used your current location.</label>
        <input class="form-control" name="geolocation" id="geolocation" placeholder="Location" onBlur="getLocation()">
        <div id="locationFound"></div>
    </div>

    <div class="page-header"><h3>Temperature</h3></div>

    <div class="btn-group" id="temperature_scale" role="group">
        <button type="button" id="t-celsius" class="btn btn-default">Celsius</button>
        <button type="button" id="t-fahrenheit" class="btn btn-default">Fahrenheit</button>
    </div>

    <div class="page-header"><h3>Server</h3></div>

    <div class="div-label">Which weather server do you prefer?</div>
    <div class="btn-group" id="server" role="group">
        <button type="button" class="btn btn-default" id="yahooweather">YahooWeather</button>
        <button type="button" class="btn btn-default" id="openweathermap">OpenWeatherMap</button>
    </div>

    <script>
        $('#server').find('button').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            getLocation();
        });

        defaults.server = 'yahooweather';
    </script>

    <?php
    if (isset($_GET['version']) && $_GET['version'] >= 3.0) :
        ?>
        <div id="openweathermap_api_key_block">
            <div class="page-header"><h3>OpenWeatherMap API Key</h3></div>

            <div class="div-label">You can enter your own API Key for OpenWeatherMap if you want.</div>
            <div class="form-group" id="openweathermap_api_key_group" role="group">
                <input class="form-control" placeholder="api key (optional)" id="openweathermap_api_key">
            </div>
        </div>

        <script>
            document.getElementById('yahooweather').onclick = function(){$('#openweathermap_api_key_block').css('display', 'none')};
            document.getElementById('openweathermap').onclick = function(){$('#openweathermap_api_key_block').css('display', 'block')};
        </script>
        <?php
    endif;
    ?>

    <div class="page-header"><h3>Screen background</h3></div>

    <?php
    if (isset($_GET['platform']) && !strcmp($_GET['platform'], 'aplite')) :
    ?>
        <div class="btn-group" id="screen_color" role="group">
            <button type="button" class="btn btn-default" id="FFFFFF">White</button>
            <button type="button" class="btn btn-default" id="000000">Black</button>
        </div>

        <script>
            $('#screen_color.btn-group').find('button').click(function() {
                $(this).addClass('active').siblings().removeClass('active');
            });

            defaults.screen_color = 'FFFFFF';
        </script>
    <?php
    else :
    ?>
        <div class="btn-group" id="screen_color" role="group">
            <button type="button" class="btn btn-default" id="auto">Auto</button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="name">Static</span>
                <span class="caret"></span>
            </button>
            <div class="dropdown-menu">
                <span id="00FF00" class="color-container green">
                    <span class="second-color"></span>
                </span>
                <span id="55FF00" class="color-container bright-green">
                    <span class="second-color"></span>
                </span>
                <span id="55FF55" class="color-container screaming-green">
                    <span class="second-color"></span>
                </span>
                <span id="00FF55" class="color-container malachite">
                    <span class="second-color"></span>
                </span>
                <span id="00AA00" class="color-container islamic-green">
                    <span class="second-color"></span>
                </span>
                <span id="00FFAA" class="color-container medium-spring-green">
                    <span class="second-color"></span>
                </span>
                <span id="00AA55" class="color-container jaeger-green">
                    <span class="second-color"></span>
                </span>
                <span id="55FFAA" class="color-container medium-aquamarine">
                    <span class="second-color"></span>
                </span>
                <span id="55FFFF" class="color-container electric-blue">
                    <span class="second-color"></span>
                </span>
                <span id="00FFFF" class="color-container cyan">
                    <span class="second-color"></span>
                </span>
                <span id="00AAAA" class="color-container tiffany-blue">
                    <span class="second-color"></span>
                </span>
                <span id="0055AA" class="color-container cobalt-blue">
                    <span class="second-color"></span>
                </span>
                <span id="00AAFF" class="color-container vivid-cerulean">
                    <span class="second-color"></span>
                </span>
                <span id="55AAFF" class="color-container picton-blue">
                    <span class="second-color"></span>
                </span>
                <span id="0055FF" class="color-container blue-moon">
                    <span class="second-color"></span>
                </span>
                <span id="5500FF" class="color-container electric-ultramarine">
                    <span class="second-color"></span>
                </span>
                <span id="5555FF" class="color-container very-light-blue">
                    <span class="second-color"></span>
                </span>
                <span id="5555AA" class="color-container liberty">
                    <span class="second-color"></span>
                </span>
                <span id="5500AA" class="color-container indigo-web">
                    <span class="second-color"></span>
                </span>
                <span id="AA00FF" class="color-container vivid-violet">
                    <span class="second-color"></span>
                </span>
                <span id="AA55FF" class="color-container lavender-indigo">
                    <span class="second-color"></span>
                </span>
                <span id="AA55AA" class="color-container purpureus">
                    <span class="second-color"></span>
                </span>
                <span id="AA00AA" class="color-container purple">
                    <span class="second-color"></span>
                </span>
                <span id="FF00AA" class="color-container fashion-magenta">
                    <span class="second-color"></span>
                </span>
                <span id="FF00FF" class="color-container magenta">
                    <span class="second-color"></span>
                </span>
                <span id="FF55FF" class="color-container shocking-pink-crayola">
                    <span class="second-color"></span>
                </span>
                <span id="FF55AA" class="color-container brilliant-rose">
                    <span class="second-color"></span>
                </span>
                <span id="FF0055" class="color-container folly">
                    <span class="second-color"></span>
                </span>
                <span id="FF5555" class="color-container sunset-orange">
                    <span class="second-color"></span>
                </span>
                <span id="AA5555" class="color-container rose-vale">
                    <span class="second-color"></span>
                </span>
                <span id="AA5500" class="color-container windsor-tan">
                    <span class="second-color"></span>
                </span>
                <span id="FF0000" class="color-container red">
                    <span class="second-color"></span>
                </span>
                <span id="FF5500" class="color-container orange">
                    <span class="second-color"></span>
                </span>
                <span id="FFAA00" class="color-container chrome-yellow">
                    <span class="second-color"></span>
                </span>
                <span id="FFAA55" class="color-container rajah">
                    <span class="second-color"></span>
                </span>
                <span id="FFFF55" class="color-container icterine">
                    <span class="second-color"></span>
                </span>
                <span id="FFFF00" class="color-container yellow">
                    <span class="second-color"></span>
                </span>
                <span id="AAAA00" class="color-container limerick">
                    <span class="second-color"></span>
                </span>
            </div>
        </div>

        <script>
            $('#screen_color')
                .find('button#auto').click(function() {
                    $(this).addClass('active')
                        .siblings('button').attr("class","btn btn-default dropdown-toggle")
                        .siblings('.dropdown-menu').find('.color-container').removeClass('active');
                })
                .parent().find('.dropdown-menu').find('.color-container').click(function() {
                    var el = $(this);
                    var color = el.attr('class');
                    el.closest('.dropdown-menu').find('.color-container').removeClass('active');
                    el.addClass('active');
                    $('#screen_color').find('button').find('.name')
                        .parent().attr("class","btn btn-default dropdown-toggle "+color)
                        .siblings().removeClass('active');
                });

            defaults.screen_color = 'auto';
        </script>
    <?php
    endif;
    ?>

    <div class="page-header"><h3>Bluetooth icon</h3></div>

    <div class="div-label">When would you like to see bluetooth icon?</div>
    <div class="btn-group" id="bluetooth" role="group">
        <button type="button" class="btn btn-default" id="never">Never</button>
        <button type="button" class="btn btn-default" id="on_disconnect">On disconnect</button>
        <button type="button" class="btn btn-default" id="always">Always</button>
    </div>

    <div class="page-header"><h3>Battery icon</h3></div>

    <div class="div-label">When would you like to see battery icon?</div>
    <div class="btn-group" id="battery" role="group">
        <button type="button" class="btn btn-default" id="on_charge">On charge</button>
        <button type="button" class="btn btn-default" id="battery_always">Always</button>
    </div>

    <script>
        defaults.battery = 'on_charge';
    </script>

    <div class="page-header"><h3>Hourly vibration</h3></div>

    <div class="div-label">Would you like to have your watch vibrate every hour?</div>
    <div class="btn-group" id="hourly_beep" role="group">
        <button type="button" class="btn btn-default" id="beep">Yes</button>
        <button type="button" class="btn btn-default" id="do_not_beep">No</button>
    </div>

    <script>
        defaults.hourly_beep = 'do_not_beep';
    </script>

    <div class="page-header"><h3>Don't disturb</h3></div>

    <div class="btn-group" id="dnd" role="group">
        <button type="button" class="btn btn-default" onclick="$('#dnd_interval_container').show();" id="dnd_on">On</button>
        <button type="button" class="btn btn-default" onclick="$('#dnd_interval_container').hide().find('input').removeClass('has-error');" id="dnd_off">Off</button>
    </div>

    <div id="dnd_interval_container">
        <div class="div-label">Set interval of hours when you don't want be disturbed.</div>
        <div class="form-group" id="dnd_interval" role="group">
            <input class="form-control" placeholder="from [0-23]" id="dnd_start">
            <input class="form-control" placeholder="till [0-23]" id="dnd_end">
        </div>
    </div>

    <script>
        $('#dnd_interval_container').find('input').blur(function() {
            var value = $(this).val().trim();
            if (is_valid_hour(value)) {
                $(this).removeClass("has-error");
            }
            else {
                $(this).addClass("has-error");
            }
        });

        defaults.dnd = 'dnd_off';
    </script>

<?php
if (isset($_GET['version']) && $_GET['version'] >= 1.1) :
?>
    <div class="page-header"><h3>Hour leading zero</h3></div>

    <div class="div-label">Should leading zero be shown in hours?</div>
    <div class="btn-group" id="hour_lead_zero" role="group">
        <button type="button" class="btn btn-default" id="show_zero_in_hours">Yes</button>
        <button type="button" class="btn btn-default" id="do_not_show_zero_in_hours">No</button>
    </div>

    <script>
        defaults.hour_lead_zero = 'show_zero_in_hours';
    </script>

    <div class="page-header"><h3>Humidity or Day of Week</h3></div>

    <div class="div-label">Would you like to see humidity or day of week?</div>
    <div class="btn-group" id="day_of_week_humidity" role="group">
        <button type="button" class="btn btn-default" id="show_day_of_week">Day of Week</button>
        <button type="button" class="btn btn-default" id="show_humidity">Humidity</button>
    </div>

    <script>
        defaults.day_of_week_humidity = 'show_day_of_week';
    </script>
<?php
endif;
?>

    <div class="page-header"></div>

    <div class="error">All fields should have correct value.</div>

    <div class="buttons">
        <div class="save-div">
            <a class="save" href="#" id="b-submit">Save</a>
        </div>
        <div class="cancel-div">
            <a href="#" id="b-cancel">Cancel</a>
        </div>
    </div>
</div>

<script>
    function is_valid_hour(value) {
        return value%1 === 0 && 0<=value && value<=23 && value!=='';
    }

    $('#b-cancel').click(function() {
        document.location = 'pebblejs://close';
    });

    $('#b-submit').click(function() {
        if ($('#dnd_on').hasClass('active')) {
            $('#dnd_interval_container').find('input').each(function(){
                var value = $(this).val().trim();
                if (is_valid_hour(value)) {
                    $(this).removeClass("has-error");
                }
                else {
                    $(this).addClass("has-error");
                }
            });
        }

        var error = $('.error');
        if ($('.has-error').length > 0) {
            error.show();
            return false;
        }
        error.hide();

        document.location = 'pebblejs://close#' + encodeURIComponent(JSON.stringify(saveOptions()));
    });

    function saveOptions() {
        var options = {
            location: $('#geolocation').val()
        };

        $('.btn-group').each(function(i, el) {
            options[el.id] = $('#'+el.id+' .active')[0].id;
        });

        $('.form-group input').each(function(i, el) {
            options[el.id] = el.value;
        });

        return options;
    }

    $('.btn-group button').click(function() {
        if (this.parentNode.getAttribute('id') != 'server' && this.parentNode.getAttribute('id') != 'screen_color') {
            $(this).addClass('active').siblings().removeClass('active');
        }
    });

    $('#donate-btn').click(function(){
        $('.sweet-overlay').css('display','block');
        $('.loader').css('display','block');
    });

    function getURLVariable(name)  {
        name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
        var regexS = "[\\?&]"+name+"=([^&#]*)",
                regex = new RegExp(regexS),
                results = regex.exec(window.location.href);
        if (results == null) return "";
        else return results[1];
    }
    var xhrRequest = function (url, type, callback) {
        var xhr = new XMLHttpRequest();
        xhr.onload = function () {
            callback(this.responseText);
        };
        xhr.open(type, url);
        xhr.send();
    };

    function getLocation() {
        if (document.getElementById('geolocation').value) {
            if (document.getElementById('server')) {
                var selectedServer = $('#server').find('.active').attr('id');
                if (selectedServer.toLowerCase() == "openweathermap".toLowerCase()) {
                    locationFromOpenWeatherMap();
                }
                else {
                    locationFromYahooWeather();
                }
            }
            else {
                locationFromYahooWeather();
            }
        }
        else {
            setLocationFound("");
        }
    }

    function setLocationFound(text) {
        if (text === null) {
            document.getElementById('locationFound').textContent = "Locality is not found on this weather server.";
        }
        else {
            document.getElementById('locationFound').textContent = text;
        }
    }

    function locationFromYahooWeather() {
        var url = 'https://query.yahooapis.com/v1/public/yql?format=json&q=' +
            encodeURIComponent('select * from geo.places(1) where text="' +
            document.getElementById('geolocation').value + '"');


        // Send request to YahooWeather
        xhrRequest(url, 'GET',
            function(responseText) {
                var locaionFound = '';

                if (typeof(responseText) == "undefined" || responseText.indexOf("failed to connect") >= 0) {
                    locaionFound = "No response from weather server.";
                }
                else {
                    // responseText contains a JSON object with weather info
                    var json = JSON.parse(responseText);

                    if (json.query.results === null) {
                        locaionFound = null;
                    }
                    else {
                        if (json.query.results.place.country) {
                            locaionFound += json.query.results.place.country.content;
                        }
                        if (json.query.results.place.admin1) {
                            locaionFound += ", " + json.query.results.place.admin1.content;
                        }
                        if (json.query.results.place.admin2) {
                            locaionFound += ", " + json.query.results.place.admin2.content;
                        }
                        if (json.query.results.place.locality1) {
                            locaionFound += ", " + json.query.results.place.locality1.content;
                        }
                    }
                }

                setLocationFound(locaionFound);
            }
        );
    }

    function locationFromOpenWeatherMap() {
        var url = "tools.php?get_openweathermap_apikey";

        xhrRequest(url, 'GET', function(responseText) {
            var apikey = false;
            // responseText contains a JSON object
            var json = JSON.parse(responseText);

            if (json.apikey) {
                apikey = json.apikey;
            }

            var url = "http://api.openweathermap.org/data/2.5/weather?q=" +
                encodeURIComponent(document.getElementById('geolocation').value);

            if (apikey) {
                url += '&APPID=' + apikey;
            }

            // Send request to YahooWeather
            xhrRequest(url, 'GET', function (responseText) {
                var locaionFound = '';

                if (typeof(responseText) == "undefined" || responseText.indexOf("failed to connect") >= 0) {
                    locaionFound = "No response from weather server.";
                }
                else {
                    // responseText contains a JSON object with weather info
                    var json = JSON.parse(responseText);

                    if (parseInt(json.cod) == 404) {
                        locaionFound = null;
                    }
                    else {
                        if (json.sys.country) {
                            locaionFound += json.sys.country;
                        }
                        locaionFound += ((locaionFound && json.name) ? ", " : "") + json.name;
                    }
                }

                setLocationFound(locaionFound);
            });
        });
    }

    $(document).ready(function() {
        var geoLocation = getURLVariable('location');
        geoLocation = decodeURIComponent(geoLocation);

        if (geoLocation) {
            $('#geolocation').val(geoLocation);
        }

        var dnd_start = getURLVariable('dnd_start');
        dnd_start = decodeURIComponent(dnd_start);

        if (dnd_start) {
            $('#dnd_start').val(dnd_start);
        }

        var dnd_end = getURLVariable('dnd_end');
        dnd_end = decodeURIComponent(dnd_end);

        if (dnd_end) {
            $('#dnd_end').val(dnd_end);
        }

        var screen_color = getURLVariable('screen_color');
        screen_color = decodeURIComponent(screen_color);

        if (screen_color) {
            $('#screen_color').find('button').find('.name').parent()
                .addClass($('.dropdown-menu').find('#'+screen_color).attr('class'));
        }

        // Show selected properties
        Object.getOwnPropertyNames(defaults).forEach(function(name) {
            var default_value = Object.getOwnPropertyDescriptor(defaults, name).value;

            var param = getURLVariable(name);
            param = decodeURIComponent(param);

            if (param) {
                $('#'+param).addClass('active');
            }
            else {
                $('#'+default_value).addClass('active');
            }

            if (param == 'dnd_on') {
                $('#dnd_interval_container').show();
            }

            if (param == 'openweathermap') {
                $('#openweathermap_api_key_block').css('display', 'block');
            }
        });

        getLocation();
    });
</script>