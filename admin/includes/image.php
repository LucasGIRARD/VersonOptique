 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <title></title>
            <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
            <script type="text/javascript" src="js/jQueryRotate.js"></script>
            <script type="text/javascript">
                var angle = 0;
                var Image
                var unit = 1;
                var heightImage
                var widthImage

                var newHeightImage
                var newWidthImage

                var blackTop
                var blackBottom
                var blackLeft
                var blackRight

                var blackTopHeight
                var blackBottomHeight
                var blackLeftWidth
                var blackRightWidth

                function load(){                    
                    Image = document.getElementById('photo');
                    heightImage = parseInt(Image.height, 10);
                    widthImage = parseInt(Image.width, 10);


                    document.getElementById('bod').style.width = widthImage+"px";

                    blackTop = document.getElementById('blackTop').style;
                    blackBottom = document.getElementById('blackBottom').style;
                    blackLeft = document.getElementById('blackLeft').style;
                    blackRight = document.getElementById('blackRight').style;

                    blackTop.width = widthImage+"px";

                    blackBottom.top = heightImage+"px";
                    blackBottom.width = widthImage+"px";

                    blackLeft.height = heightImage+2+"px";

                    blackRight.height = heightImage+2+"px";
                    blackRight.left = widthImage+"px";


                    blackLeftWidth = parseInt(blackLeft.width, 10)-1;
                    blackRightWidth = parseInt(blackRight.width, 10)-1;
                    blackTopHeight = parseInt(blackTop.height, 10)-1;
                    blackBottomHeight = parseInt(blackBottom.height, 10)-1;


                    heightValue();
                    widthValue();
                    angleValue();
                }
                function changeUnit() {
                    unit = parseInt(document.getElementById('unit').value, 10);
                }

                function heightValue() {
                    newHeightImage = heightImage - blackTopHeight - blackBottomHeight;
                    document.getElementById('heightValue').innerHTML = newHeightImage;
                }
                function widthValue() {
                    newWidthImage = widthImage - blackLeftWidth - blackRightWidth;
                    document.getElementById('widthValue').innerHTML = newWidthImage;
                }
                function angleValue() {
                    document.getElementById('angleValue').innerHTML = angle;
                }

                function heightTopMore() {
                    if (blackTopHeight >= 0){
                        blackTop.height = parseInt(blackTop.height, 10)+unit +"px";
                        blackTopHeight = parseInt(blackTop.height, 10)-1;
                    }
                    else if(blackTopHeight < 0){
                        blackTop.top = parseInt(blackTop.top, 10)+unit +"px";
                        blackLeft.top = parseInt(blackLeft.top, 10)+unit +"px";
                        blackLeft.height = parseInt(blackLeft.height, 10)-unit +"px";
                        blackRight.top = parseInt(blackRight.top, 10)+unit +"px";
                        blackRight.height = parseInt(blackRight.height, 10)-unit +"px";
                        blackTopHeight = parseInt(blackTop.height, 10)-1+parseInt(blackTop.top, 10)+1;
                    }
                    heightValue();
                }
                function heightTopLess() {
                    if (blackTopHeight > 0){
                        blackTop.height = parseInt(blackTop.height, 10)-unit +"px";
                        blackTopHeight = parseInt(blackTop.height, 10)-1;
                    }
                    else if(blackTopHeight <= 0){
                        blackTop.top = parseInt(blackTop.top, 10)-unit +"px";
                        blackLeft.top = parseInt(blackLeft.top, 10)-unit +"px";
                        blackLeft.height = parseInt(blackLeft.height, 10)+unit +"px";
                        blackRight.top = parseInt(blackRight.top, 10)-unit +"px";
                        blackRight.height = parseInt(blackRight.height, 10)+unit +"px";
                        blackTopHeight = parseInt(blackTop.height, 10)-1+parseInt(blackTop.top, 10)+1;
                    }
                    heightValue();
                }

                function heightBottomMore() {
                    if (blackBottomHeight >= 0){
                        blackBottom.height = parseInt(blackBottom.height, 10)+unit +"px";
                        blackBottom.top = parseInt(blackBottom.top, 10)-unit +"px";
                        blackBottomHeight = parseInt(blackBottom.height, 10)-1;
                    }
                    else if(blackBottomHeight < 0){
                        blackBottom.top = parseInt(blackBottom.top, 10)-unit +"px";
                        blackLeft.height = parseInt(blackLeft.height, 10)-unit +"px";
                        blackRight.height = parseInt(blackRight.height, 10)-unit +"px";
                        blackBottomHeight = parseInt(blackBottom.height, 10)-1-(parseInt(blackBottom.top, 10) - heightImage);
                    }
                    heightValue();
                }
                function heightBottomLess() {
                    if (blackBottomHeight > 0){
                        blackBottom.height = parseInt(blackBottom.height, 10)-unit +"px";
                        blackBottom.top = parseInt(blackBottom.top, 10)+unit +"px";
                        blackBottomHeight = parseInt(blackBottom.height, 10)-1;
                    }
                    else if(blackBottomHeight <= 0){
                        blackBottom.top = parseInt(blackBottom.top, 10)+unit +"px";
                        blackLeft.height = parseInt(blackLeft.height, 10)+unit +"px";
                        blackRight.height = parseInt(blackRight.height, 10)+unit +"px";
                        blackBottomHeight = parseInt(blackBottom.height, 10)-1-(parseInt(blackBottom.top, 10) - heightImage);
                    }
                    heightValue();
                }

                function widthLeftMore() {
                    if (blackLeftWidth >= 0){
                        blackLeft.width = parseInt(blackLeft.width, 10)+unit +"px";
                        blackLeftWidth = parseInt(blackLeft.width, 10)-1;
                    }
                    else if(blackLeftWidth < 0){
                        blackLeft.left = parseInt(blackLeft.left, 10)+unit +"px";
                        blackTop.left = parseInt(blackTop.left, 10)+unit +"px";
                        blackTop.width = parseInt(blackTop.width, 10)-unit +"px";
                        blackBottom.left = parseInt(blackBottom.left, 10)+unit +"px";
                        blackBottom.width = parseInt(blackBottom.width, 10)-unit +"px";
                        blackLeftWidth = (parseInt(blackLeft.width, 10)-1)+(parseInt(blackLeft.left, 10)+1);
                    }
                    widthValue();
                }
                function widthLeftLess() {
                    if (blackLeftWidth > 0){
                        blackLeft.width = parseInt(blackLeft.width, 10)-unit +"px";
                        blackLeftWidth = parseInt(blackLeft.width, 10)-1;
                    }
                    else if(blackLeftWidth <= 0){
                        blackLeft.left = parseInt(blackLeft.left, 10)-unit +"px";
                        blackTop.left = parseInt(blackTop.left, 10)-unit +"px";
                        blackTop.width = parseInt(blackTop.width, 10)+unit +"px";
                        blackBottom.left = parseInt(blackBottom.left, 10)-unit +"px";
                        blackBottom.width = parseInt(blackBottom.width, 10)+unit +"px";
                        blackLeftWidth = parseInt(blackLeft.width, 10)-1+parseInt(blackLeft.left, 10)+1;
                    }
                    widthValue();
                }

                function widthRightMore() {
                    if (blackRightWidth >= 0){
                        blackRight.width = parseInt(blackRight.width, 10)+unit +"px";
                        blackRight.left = parseInt(blackRight.left, 10)-unit +"px";
                        blackRightWidth = parseInt(blackRight.width, 10)-1;
                    }
                    else if(blackRightWidth < 0){
                        blackRight.left = parseInt(blackRight.left, 10)-unit +"px";
                        blackTop.width = parseInt(blackTop.width, 10)-unit +"px";
                        blackBottom.width = parseInt(blackBottom.width, 10)-unit +"px";
                        blackRightWidth = parseInt(blackRight.width, 10)-1-(parseInt(blackRight.left, 10) - widthImage);
                    }
                    widthValue();
                }
                function widthRightLess() {
                    if (blackRightWidth > 0){
                        blackRight.width = parseInt(blackRight.width, 10)-unit +"px";
                        blackRight.left = parseInt(blackRight.left, 10)+unit +"px";
                        blackRightWidth = parseInt(blackRight.width, 10)-1;
                    }
                    else if(blackRightWidth <= 0){
                        blackRight.left = parseInt(blackRight.left, 10)+unit +"px";
                        blackTop.width = parseInt(blackTop.width, 10)+unit +"px";
                        blackBottom.width = parseInt(blackBottom.width, 10)+unit +"px";
                        blackRightWidth = parseInt(blackRight.width, 10)-1-(parseInt(blackRight.left, 10) - widthImage);
                    }
                    widthValue();
                }

                function turnMore() {
                    angle = angle + unit ;
                    $('#photo').rotate(angle);
                    angleValue();
                }
                function turnLess() {
                    angle = angle - unit ;
                    $('#photo').rotate(angle);
                    angleValue();
                }
                function loadingValues() {                   
                    document.hidden.imageNewWidth.value = newWidthImage;                    
                    document.hidden.imageNewHeight.value = newHeightImage;
                    document.hidden.blackTop.value = blackTopHeight;
                    document.hidden.blackBottom.value = blackBottomHeight;
                    document.hidden.blackRight.value = blackRightWidth;
                    document.hidden.blackLeft.value = blackLeftWidth;
                    document.hidden.angle.value = -angle;                    
                }
            </script>
        </head>
        <body onload="load();">
            <center>
                <div style="padding-top:70px">
                    <div id="bod" style="position:relative;width:10px">
                        <div id="blackTop" style="height:1px;width:0px;top:-1px;left:0px;background-color:black;position:absolute;z-index:10;"></div>
                        <div id="blackBottom" style="height:1px;width:0px;top:-1px;left:0px;background-color:black;position:absolute;z-index:10;"></div>
                        <div id="blackLeft" style="height:0px;width:1px;top:-1px;left:-1px;background-color:black;position:absolute;z-index:10;"></div>
                        <div id="blackRight" style="height:0px;width:1px;top:-1px;left:0px;background-color:black;position:absolute;z-index:10;"></div>
                    </div>
                    <div style="height:140px;">
                        <img id="photo" style="max-height:100px;max-width:100px;" alt="" src="<?php echo "../images/lunettes/original/" . $photo[1][$i] ?>" />
                    </div>

                    <table>
                        <tr>
                            <td><b>Width:</b></td>
                            <td><span id="widthValue"></span></td>
                        </tr>
                        <tr>
                            <td><b>Height:</b></td>
                            <td><span id="heightValue"></span></td>
                        </tr>
                        <tr>
                            <td><b>Angle:</b></td>
                            <td><span id="angleValue"></span>°</td>
                        </tr>
                    </table>
                    unité :<input size="2" value="1" id="unit" onblur="changeUnit();" />
                    <br />
                    haut : <button onclick="heightTopMore();">+</button><button onclick="heightTopLess();">-</button>
                    <br />
                    bas : <button onclick="heightBottomMore();">+</button><button onclick="heightBottomLess();">-</button>
                    <br />
                    gauche : <button onclick="widthLeftMore();">+</button><button onclick="widthLeftLess();">-</button>
                    <br />
                    droite : <button onclick="widthRightMore();">+</button><button onclick="widthRightLess();">-</button>
                    <br />
                    pivoter : <button onclick="turnMore();">+</button><button onclick="turnLess();">-</button>
                </div>
                <div>
                    <form name="hidden" action="index.php" method="POST">
                        <input type='hidden' name='imageNewWidth' value="" />
                        <input type='hidden' name='imageNewHeight' value="" />
                        <input type='hidden' name='blackTop' value="" />
                        <input type='hidden' name='blackBottom' value="" />
                        <input type='hidden' name='blackLeft' value="" />
                        <input type='hidden' name='blackRight' value="" />
                        <input type='hidden' name='angle' value="" />
                        <input type='hidden' name='action' value="resize" />
                        <input type='hidden' name='element' value="lunette" />
                        <input type='hidden' name='compteur' value="<?php echo $i; ?>" />
                        <input type="submit" readonly="readonly" name="valider" onmouseover="loadingValues();" value="valider" />
                    </form>
                </div>
            </center>
        </body>
    </html>