<html>
 <head>
  <title>Sample Code</title>

  <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" href = "assets/css/style.css">
  <link rel="stylesheet" href="assets/fancytree/skin-win8/ui.fancytree.css" >

  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/jquery-ui.custom.js"></script>
  <script src="assets/fancytree/jquery.fancytree.js"></script>
 
 </head>

 
<body>
    <br><br>

    <div class="container">
        <h2>JSON Live Data Search using Ajax JQuery</h2>
        <h4>Exercise 1</h4>  
        <h5>Load employee data from data.json file</h5>
        <br>
        <div>
            <input type="text" name="search" id="search" placeholder="Search Employee Details" class="form-control" />
        </div>
        <ul class="list-group" id="result"></ul>
        <br>Employee data: <p id = "exer01"></p>
        <hr>
        <br>

        <h4>Exercise 2</h4> 
        <h5>Load data using JSON.parse</h5>
        <p id = "exer02"></p>
        <hr>
        <br>

        <h4>Exercise 3</h4> 
        <h5>Load data with different implementation</h5>
        <p id = "exer03"></p>
        <hr>
        <br>
        
        <h4>Exercise 4</h4> 
        <h5>Fancytree</h5>
        <div id="tree"></div>
        <div id="statusLine">-</div>
        <p>
            <button id="button1">Select item2</button>
        </p>
    </div>


</body>
</html>



<script>

/******************************************************************************/
//Exercise 01

$(document).ready(function(){
    $.ajaxSetup({ cache: false });
    $('#search').keyup(function(){
        $('#result').html('');
         
        var searchField = $('#search').val();
        var expression = new RegExp(searchField, "i");
        $.getJSON('data.json', function(data) {
           $.each(data, function(key, value){
                if (value.name.search(expression) != -1 || value.location.search(expression) != -1){
                    $('#result').append('<li class="list-group-item link-class"> '+value.name+' | <span class="text-muted">'+value.location+'</span></li>');
                }
           });   
        });
    });
 
    $('#result').on('click', 'li', function() {
        var click_text = $(this).text().split('|');
        $('#search').val($.trim(click_text[0]));
        document.getElementById("exer01").innerHTML = click_text;
        $("#result").html('');
    });    

});


/*******************************************************************************/
//Exercise 02

var obj = JSON.parse('{ "name":"John", "age":30, "city":"New York"}');
document.getElementById("exer02").innerHTML = obj.name + ", " + obj.age;


/********************************************************************************/
//Exercise 03

var obj = {"data": [
    {
     "name": "Rehan",
     "location": "Pune",
     "description": "hello hi",
     "created_by": 13692,
     "users_name": "xyz",
    },
    {
      "name": "Sameer",
      "location": "Bangalore",
      "description": "how are you",
      "created_by": 13543,
      "users_name": "abc",
    }
    ]}

var divId = document.getElementById("exer03")

for(var i=0;i<obj.data.length;i++){
    for(var keys in obj.data[i]){
        divId.innerHTML += "<br>"+ keys +": "+obj.data[i][keys];
    }
    divId.innerHTML += "<br>";
}

/*********************************************************************************/
//Exercise 04

$(function(){
    $("#tree").fancytree({
        checkbox: true,
        source: [
            {title: "Node 1", lazy : true},
            {title: "Node 2", key: "id2"},
            {title: "Folder 3", folder: true, children: [
                {title: "Node 3.1"},
                {title: "Node 3.2"}
            ]},
            {title: "Folder 2", folder: true}
        ],
        activate: function(event, data){
            $("#statusLine").text("Active node: " + data.node);
        }
    });
    
    // Activate a node, on button click
    $("#button1").click(function(){
        var tree = $("#tree").fancytree("getTree"),
            node2 = tree.getNodeByKey("id2");
        node2.toggleSelected();
    });
});


</script>
