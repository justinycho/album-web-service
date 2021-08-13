<html>
<head>
<title>Albums Web Service Demo</title>
<style>
    body {font-family:georgia;}

    .album{
        border:1px solid #E77DC2;
        border-radius: 5px;
        padding: 5px;
        margin-bottom:5px;
        position:relative;    
    }

    .pic{
        position:absolute;
        right:10px;
        top:10px;
    }

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {  

    $('.category').click(function(e){
        e.preventDefault(); //stop default action of the link
        cat = $(this).attr("href");  //get category from URL
        loadAJAX(cat);  //load AJAX and parse JSON file
    });
});    
/*
function loadAJAX(cat)
{
    //AJAX connection will go here
    //alert('cat is: ' + cat);

    $.ajax({
        type: "GET",
        dataType: "json",
        url: "api.php?cat=" + cat,
        success: bondJSON

    });


}
*/
function loadAJAX(cat)
{
   $.ajax({
       type: "GET",
       dataType: "json",
       url: "api.php?cat=" + cat,
       success: bondJSON,
       error: function(xhr, status, error){
        let errorMessage = xhr.status + ': ' + xhr.statusText
        alert('Error - ' + errorMessage);
    }
 
   });
}

    
function toConsole(data)
{//return data to console for JSON examination
    console.log(data); //to view,use Chrome console, ctrl + shift + j
}

function bondJSON(data){
    //Here is how I see data returned via the console
    console.log(data);

    //identifies the type of data returned
    $('#filmtitle').html(data.title);

    //clears other clicked films
    $('#films').html('');

    //loop through films and add template
    
    $.each(data.albums,function(i,item){
        let myAlbum = bondTemplate(item);

        $('<div></div>').html(myAlbum).appendTo('#films');

    });
    
    //$("#output").text(JSON.stringify(data));

    //this creates a map of the JSON on our page
    
    /*
    let myData = JSON.stringify(data,null,4);
    myData = "<pre>" + myData + "</pre>"
    $("#output").html(myData);
    */
}

function bondTemplate(album){

    return `
        <div class="album">
            <b>Title: </b>${album.Title}</br>
            <b>Genre: </b>${album.Genre}</br>
            <b>Company: </b>${album.Company}</br>
            <b>Year: </b>${album.Year}</br>
            <b>Rating: </b>${album.Rating}</br>
            <div class="pic"><img src="thumbnails/${album.Image}" /></div>
        </div>
    `;

}

</script>
</head>
    <body>
    <h1>Albums Web Service</h1>
        <a href="year" class="category">Albums By Year</a><br />
        <a href="genre" class="category">Albums By Genre</a>
        <h3 id="filmtitle">Title Will Go Here</h3>
        <div id="films">
            <!--
            <div class="film">
            <b>Film: </b> 1</br>
            <b>Title: </b> Dr. No</br>
            <b>Year: </b> 1962</br>
            <b>Director: </b> Terence Young</br>
            <b>Producers: </b> Harry Saltzman and Albert R. Broccoli</br>
            <b>Writers: </b> Richard Maibaum, Johanna Harwood and Berkely Mather</br>
            <b>Composer: </b> Monty Norman</br>
            <b>Bond: </b> Sean Connery</br>
            <b>Budget: </b> $1,000,000.00</br>
            <b>Box Office:</b> $59,567,035.00</br>
            <div class="pic"><img src="thumbnails/dr-no.jpg" /></div>
        </div>
            -->
        </div>
        <div id="output">Results go here</div>
    </body>
</html>