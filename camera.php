<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php"; 

?>

    <!-- Page Content -->
    <div class="container" style="padding:0;margin:0;height:100%;width:100%;overflow-x:hidden;">
        <div class="row" style="text-align:center;padding:10px 20px 5px 20px;">
                            <span style="float:left;padding:5px 10px;"><a href="index.php"><span style="font-size:16pt;"class="glyphicon glyphicon-arrow-left"></span></a></span>
                            <span style="float:none;padding:8px 10px 2px 0;margin-left:-25px;margin-bottom:-5px;font-weight:bold;font-size:16pt;">Camera</span>
                        </div>
   <div id="container">
     <video id="video" autoplay style="width:100%;height:100%;background-color:rgba(0,0,0,1);" /><p>
    </div>
<div class="row">
    <div style="width:49%; float:left;text-align:center;">
        <button class="btn btn-default" style="color:black;width:80%;padding:25px 0 25px 10px;" onclick="startFunction()">Record <i style="color:red" class="glyphicon glyphicon-record"></i></button></div>
    <div style="width:49%; float:left;text-align:center;">
        <button class="btn btn-default" style="color:black;width:80%;padding:25px 10px 25px 0;" onclick="download()">Stop <i style="color:red" class="glyphicon glyphicon-stop"></i></button>
    </div>
 </div>
        <div class="row" style="padding:20px;">
            <a class="btn btn-info" href="admin/posts.php?source=add_post">Upload from device...</a>
        </div>

                    </div>
                
               
            <script>
    const constraints = { "video": { width: { max: 320 } }, "audio": true };

    var theStream;
    var theRecorder;
    var recordedChunks = [];

    function startFunction() {
        navigator.mediaDevices.getUserMedia(constraints)
            .then(gotMedia)
            .catch(e => { console.error('getUserMedia() failed: ' + e); });
    }

    function gotMedia(stream) {
        theStream = stream;
        var video = document.getElementById('video');
        video.srcObject = stream;
        try {
            recorder = new MediaRecorder(stream, { mimeType: "video/webm" });
        } catch (e) {
            console.error('Exception while creating MediaRecorder: ' + e);
            return;
        }

        theRecorder = recorder;
        recorder.ondataavailable =
            (event) => { recordedChunks.push(event.data); };
        recorder.start(100);
    }

    // From samdutton's "Record Audio and Video with MediaRecorder"
    // https://developers.google.com/web/updates/2016/01/mediarecorder
    function download() {
        theRecorder.stop();
        theStream.getTracks().forEach(track => { track.stop(); });

        var blob = new Blob(recordedChunks, { type: "video/webm" });
        var url = URL.createObjectURL(blob);
        var a = document.createElement("a");
        document.body.appendChild(a);
        a.style = "display: none";
        a.href = url;
        a.download = 'test.webm';
        a.click();
        // setTimeout() here is needed for Firefox.
        setTimeout(function () { URL.revokeObjectURL(url); }, 100);
    }

    function showUploader() {
        document.getElementById('imageuploader').style.display = 'block';
        document.getElementById('imageuploaderbutton').style.display = 'none';
    }
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
   </div>
<div class="bottom-navbar" style="width:100%;text-align:center;" style="position:fixed;bottom:0;width:100%;">
            <div style="width:25%;text-align:center;float:left;padding-left:25px;">
                <a href="index.php"><span class="glyphicon glyphicon-home"></span></a>
            </div>
            <div  style="width:25%;text-align:center;float:left;">
                <a href="search.php" ><span class="glyphicon glyphicon-search"></span></a>
            </div>
            <div style="width:25%;text-align:center;float:left;">
                <a href="camera.php" ><span class="glyphicon glyphicon-camera"></span></a>
            </div>
            <div style="width:25%;text-align:center;float:left;">
                <a href="admin/index.php" ><span class="glyphicon glyphicon-user"></span></a>
            </div>
</div> 
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>