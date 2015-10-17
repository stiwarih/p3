<!DOCTYPE html>
<html>
    <head>
        <title>Lorem Ipsum Generator</title>

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
            .para {
			           margin-bottom:5px;
		        }

        </style>
    </head>
    <body>
      <a href='http://p3.stiwari.me/'><---Go Home</a>

      <h1>Lorem Ipsum Generator</h1>
      How many paragraphs do you want?

      	<form method='POST'>

      		<label for="paragraphs">Paragraphs</label>
      		<input maxlength="2" name="paragraphs" type="text" value="5" id="paragraphs"> (Max: 99)

      		<br><br>

      		<input type="submit" value="Generate paragraphs">
          </form>
          <section>
          @foreach($paragraphs as $paragraph)
          <p><div class='rcorners2'>
           {{ $paragraph }}
          </div>
          @endforeach
          </section>

          <a href='http://p3.stiwari.me/'><---Go Home</a>

    </body>
</html>
