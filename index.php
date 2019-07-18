<!DOCTYPE html>
 
<html>
 
<head>
 
</head>
 
<body>
 
<script>
 
var posX=0;
 
var posY=80;
 
var xNegative=false;
 
var yNegative=false;
 
var time=0;
 
var bricks =new Array();
 
var active=true;
 
  
 
function mainLoop(){
 
    if(!active) return;
 
    time++;
 
    frameRender();
 
    setTimeout("mainLoop()",1);
 
}
 
  
 
function tileHit(){
 
    yNegative=true;
 
}
 
  
 
function brickHit(brick){
 
    yNegative=false;
 
    clip.removeChild(brick);
 
    bricks.splice(bricks.indexOf(brick),1);
 
}
 
  
 
function gameOver(){
 
    if(confirm("Game is over. Do you want to play again?")){
 
        posX=0;
 
        posY=20;
 
        xNegative=false;
 
        yNegative=false;
 
        time=0;
 
        brickReset();
 
    }else
 
        active=false;
 
}
 
  
 
function brickReset(){
 
    var brickPositionX=110;
 
    var brickPositionY=0;
 
    for(var i=0;i<10;i++){
 
        if(i%5==0 && i>3){
 
            brickPositionY+=70;
 
            brickPositionX=110;
 
        }
 
        var brick = document.createElement("div");
 
        brick.style.backgroundImage = "url('brick.png')";
 
        brick.style.width="70px";
 
        brick.style.height="70px";
 
        brick.style.position="absolute";
 
        brick.style.top = brickPositionY + "px";
 
        brick.style.left = brickPositionX + "px";
 
        brickPositionX+=70;
 
        clip.appendChild(brick);
 
        bricks.push(brick);
 
    }
 
}
 
  
 
function brickCollisionCheck(bricks, object){
 
    for(var i=0;i<bricks.length;i++){
 
        if(parseInt(bricks[i].style.top)+parseInt(bricks[i].style.height)>parseInt(object.style.top)&&
 
        parseInt(bricks[i].style.left)+parseInt(bricks[i].style.width)>parseInt(object.style.left)&&
 
        parseInt(bricks[i].style.left)<parseInt(object.style.left)+parseInt(object.style.width) &&
 
        parseInt(bricks[i].style.top)<parseInt(object.style.top)+parseInt(object.style.height)
 
        ){
 
            brickHit(bricks[i]);
 
        }
 
    }
 
}
 
  
 
function collisionCheck(object1, object2, cbFunc){
 
    if(parseInt(object1.style.top)+parseInt(object1.style.height)>parseInt(object2.style.top)&&
 
    parseInt(object1.style.left)+parseInt(object1.style.width)>parseInt(object2.style.left)&&
 
    parseInt(object1.style.left)<parseInt(object2.style.left)+parseInt(object2.style.width) &&
 
    parseInt(object1.style.top)<parseInt(object2.style.top)+parseInt(object2.style.height))
 
        cbFunc();
 
}
 
  
 
function frameRender(){
 
    if(bricks.length<1) gameOver();
 
    collisionCheck(result,tile,tileHit);
 
    brickCollisionCheck(bricks,result);
 
    if(parseInt(result.style.left)>=(parseInt(result.parentNode.style.width)-parseInt(result.style.width))-1)
 
        xNegative=true;
 
    if(parseInt(result.style.top)>=(parseInt(result.parentNode.style.height)-parseInt(result.style.height))-1)
 
        gameOver();
 
    if(parseInt(result.style.left)<=0)
 
        xNegative=false;
 
    if(parseInt(result.style.top)<=0)
 
        yNegative=false;
 
    if(!xNegative)
 
        posX++;
 
    else
 
        posX--;
 
    if(!yNegative)
 
        posY++;
 
    else
 
        posY--;
 
    result.style.left = posX+"px";
 
    result.style.top = posY+"px";
 
}
 
  
 
window.onkeydown=function(e){
 
    if(e.keyCode==37){
 
        if(parseInt(tile.style.left)>0)
 
            tile.style.left = (parseInt(tile.style.left)-10)+"px";
 
      }
 
      
 
    if(e.keyCode==39){
 
        if(parseInt(tile.style.left)<(parseInt(clip.style.width)-parseInt(tile.style.width))-1)
 
            tile.style.left = (parseInt(tile.style.left)+10)+"px";
 
        }
 
}
 
  
 
var result = document.createElement("div");
 
result.id='result';
 
result.style.width="15px";
 
result.style.height="15px";
 
result.style.backgroundImage = "url('ball.png')";
 
result.style.position="absolute";
 
  
 
var clip = document.createElement("div");
 
clip.style.border="1px black solid";
 
clip.style.backgroundColor="white";
 
clip.style.width="600px";
 
clip.style.height="500px";
 
clip.style.backgroundImage = "url('cloud.gif')";
 
clip.style.top="3px";
 
clip.style.position="absolute";
 
  
 
var tile = document.createElement("div");
 
tile.setAttribute("id", "tile");
 
tile.style.border="1px black solid";
 
tile.style.width="50px";
 
tile.style.height="10px";
 
tile.style.position="absolute";
 
tile.style.backgroundColor = "red";
 
tile.style.top = (parseInt(clip.style.height)-parseInt(tile.style.height))-1 + "px";
 
tile.style.left = 0+"px";
 
  
 
document.body.appendChild(clip);
 
brickReset();
 
clip.appendChild(result);
 
clip.appendChild(tile);
 
mainLoop();
 
  
 
</script>
 
</body>
 
</html>