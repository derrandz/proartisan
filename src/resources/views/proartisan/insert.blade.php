<!DOCTYPE html>
<html>
    <head>
        <title>Artisan Commands Platform</title>

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>

    </head>
    <body>
        <div class="container">
            <div class="title">Enter Command.</div>
            
            <div class="content">
                <div class="container">
                    <div class="content">

              <form action="/proartisan/execute_commands" method="get" id="runArtisan">
                            {!! csrf_field() !!}

                            <div class="container">

                                <div class="content">

                                    <label class="title" for="command">Command</label>
                                    <div class="container">
                                        <input name="command" type="text" class="title">
                                    </div>

                                </div>

                                <div class="content">

                                    <label class="title" for="arguments">Arguments</label>
                                    <div class="container">
                                        <input name="arguments" type="text" class="title">
                                    </div>

                                </div>

                            </div>
                            
                                <div class="content">
                                    <button type="submit">Execute</button>
                                </div>

                </form>

                </div>
                <div class="title">Output</div>
                <div class="content">
                    <div class="title">
                        <p>
                            <strong style="color:black;">
                                @if(Session::has('flash_message'))
                                <div class="title alert <?php echo Session::get('flash_type')?>">
                                <textarea name="" id="" cols="150" rows="10">{{ Session::get('flash_message') }}</textarea>
                                </div>
                                @endif
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
          </div>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo asset('vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo asset('vendor/twitter-bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script>

$(document).ready(function() {

            $("#runArtisan").submit(function(e) {
              e.preventDefault();

                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    }
                });

                $.ajax({
                        url: "/proartisan/execute_commands",
                        type: "GET",
                        dataType: 'JSON',
                        data: $('form#runArtisan').serialize(),
                        timeout: 3000000, //Set your timeout value in milliseconds or 0 for unlimited
                
                        success: function(response) 
                        { 
                            location.reload();
                        },
                        
                        error: function(jqXHR, textStatus, errorThrown) 
                        {
                        
                            if(textStatus==="timeout") 
                            {  
                                alert("Call has timed out"); //Handle the timeout
                            } 
                            else 
                            {
                                alert(errorThrown);
                            }
                
                        }
                });

              e.preventDefault();

            });

});
</script>

    </body>
</html>
