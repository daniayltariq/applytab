<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flutter InAppBrowser</title>


</head>
<body>
<h2 id="demo">Demobgh hyg </h2>
<button onclick="myFunction()">Click me</button>


<script>
           // In order to call window.flutter_inappwebview.callHandler(handlerName <String>, ...args)
           // properly, you need to wait and listen the JavaScript event flutterInAppWebViewPlatformReady.
           // This event will be dispatched as soon as the platform (Android or iOS) is ready to handle the callHandler method.
           window.addEventListener("flutterInAppWebViewPlatformReady", function(event) {
             // call flutter handler with name 'mySum' and pass one or more arguments
             window.flutter_inappwebview.callHandler('mySum', 12, 2, 50).then(function(result) {
               // get result from Flutter side. It will be the number 64.
               console.log(result);
             });

           });

           function myFunction() {
  document.getElementById("demo").innerHTML = "Hello World";
    window.flutter_inappwebview.callHandler('mySum', "Hello I'm Fahad").then(function(result) {
               // get result from Flutter side. It will be the number 64.
              // console.log(result);
             });

}

        </script>
</body>
</html>