<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" lang="en" content="MOdulo de cobros - Procesamiento de facturas."/>
    <meta name="keywords" lang="en" content="Tomza CR" />

    <base href="http://crlcu.github.io/multiselect/" />
    
    <title>TOMZA CR - COBROS</title>
    
    <link rel="icon" type="image/x-icon" href="https://github.com/favicon.ico" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="lib/google-code-prettify/prettify.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
   
    
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
            
                </div>
                
                <div class="collapse navbar-collapse">
                    
                </div>
            </div>
        </div>
    </div>
    
    <div id="wrap" class="container">
        <h4 id="demo-optgroup">With optgroup</h4>
            
        <div class="row">
            <div class="col-sm-5">
                <select name="from" id="optgroup" class="form-control" size="8" multiple="multiple">
                    <optgroup label="Cartago">
                        <option value="27584 - CSU RL">27584 - CSU RL</option>
                        <option value="85894 - CSU RL">85894 - CSU RL</option>
                        <option value="27584 - CSU RL">27584 - PLAZA </option>
                        <option value="85894 - CSU RL">85894 - CSU RL</option>
                    </optgroup>
                    <optgroup label="German Cars">
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </optgroup>
                    <option value="1">C++</option>
                </select>
            </div>
            
            <div class="col-sm-2">
                <button type="button" id="optgroup_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                <button type="button" id="optgroup_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="optgroup_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button type="button" id="optgroup_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
            </div>
            
            <div class="col-sm-5">
                <select name="to" id="optgroup_to" class="form-control" size="8" multiple="multiple">
                    <optgroup label="Swedish Cars">
                        <option value="volvo">Volvo</option>
                    </optgroup>
                    <option value="1">C++</option>
                </select>
            </div>
        </div>

        <div class="row">
                <div class="col-xs-12">
                    <h5>HTML</h5>

            </div>
        </div>
    </div>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
<script type="text/javascript" src="dist/js/multiselect.min.js"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
    ga('create', 'UA-39934286-1', 'github.com');
    ga('send', 'pageview');
</script>

<script type="text/javascript">
$(document).ready(function() {
    // make code pretty
    window.prettyPrint && prettyPrint();

    $("#optgroup").multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Buscar..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Buscar..." />',
        },
        fireSearch: function(value) {
            return value.length > 3;
        }
    });
});
</script>
</body>
</html>
