<!--Kode untuk mencegah seleksi teks, block teks dll.-->
function disableSelection(e){
    if(typeof e.onselectstart!="undefined")
    e.onselectstart=function(){return false};
    else if(typeof e.style.MozUserSelect!="undefined")e.style.MozUserSelect="none";
    else e.onmousedown=function(){return false};
    e.style.cursor="default"}
    window.onload=function(){disableSelection(document.body)}
<!--Kode untuk mematikan fungsi klik kanan di blog-->
function mousedwn(e){
    try{
        if(event.button==2||event.button==3)
        return false
        }catch(e){
            if(e.which==3)return false
            }
    }

document.oncontextmenu=function(){return false};
document.ondragstart=function(){return false};
document.onmousedown=mousedwn;

<!--Kode untuk mencegah shorcut keyboard, view source dll.-->

window.addEventListener("keydown",function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){e.preventDefault()}});
document.keypress=function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){}return false}


document.onkeydown=function(e){e=e||window.event;if(e.keyCode==123||e.keyCode==18){return false}}
