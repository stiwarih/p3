<!DOCTYPE html>
<html>
    <head>
        <title>User Generator</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                // font-family: 'Lato';
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
                font-size: 96px;
            }
            .rcorners2 {
              border-radius: 25px;
              border: 2px solid #8AC007;
              padding: 20px;
              //width: 300px;
              //height: 250px;
              //height: auto;
            }
            .user {
			           margin-bottom:5px;
		        }
        </style>
    </head>
    <body>
      <a href='http://p3.stiwari.me/'><---Go Home</a>

        <h1>User Generator</h1>

      	<form method="POST" action="http://p3.stiwari.me/user-generator" accept-charset="UTF-8">
      		<label for="users">How many users?</label>		<input maxlength="2" name="users" type="text" value="5" id="users"> (Max: 99)
      		<br>

      		Include...
      		<br>
      		<input name="birthdate" type="checkbox">		<label for="birthdate">Birthdate</label>		<br>

      		<input name="profile" type="checkbox">		<label for="profile">Profile</label>		<br>

      		<input type="submit" value="Generate!">
          </form>
          <section>

          @foreach($users as $user)
            <p><div class='rcorners2'>
            @foreach($user as $user_data)
              <div class='user'>
              {{ $user_data }}
              </div>
            @endforeach
            </div>

          @endforeach
          </section>

          <section class='users'>

	    	    @if(isset($data))

            @foreach ($data as $user)
            <p>This is user $user->name </p>
            @endforeach

            @for ($i = 0; $i < 10; $i++)
              The current value is {{ $i }}
            @endfor
            <div class='user'>
    		    	<div class='name'>
                {{ $data['name'] }}
              </div>
              <div class='birthdate'>
                1941-08-29
              </div>
            </div>
            @endif

	        </section>
          <a href='http://p3.stiwari.me/'><---Go Home</a>
    </body>
</html>
