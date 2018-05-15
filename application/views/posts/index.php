<!DOCTYPE html>
<html>
<head>
    <title>AJAX Pagination</title>
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" /> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="src/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>posts/ajaxPaginationData/'+page_num,
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (html) {
            $('#postList').html(html);
            $('.loading').fadeOut("slow");
        }
    });
}
</script>

</head>
<style>
    .panel-transparent .panel-body{
    background: rgba(46, 51, 56, 0.2)!important;
}
.fontbg {
    color:black;
    padding:10px;
    background-color:white;
    opacity:0.8;
    border:3px solid black;
}
.fonttitle {
    color:black;
    font-family: "Trebuchet MS";
    font-weight:bold;
}
.fonttitle:hover {
    transform: scale(1.2);
    transition: 500ms;
}
.fontcolor {
    color:black;
    font-family: "Trebuchet MS";
    padding:20px;
    background-color:white;
    border-radius:5px;
    font-size:20px;
    font-weight:bold;
    border:3px solid black;
    opacity:0.8;
}
.fontcolor:hover {
    padding:10px;
    transform: scale(1.2);
    transition: 500ms;
}
</style>
<body background="bg2.jpg" style="margin-top: 2%">


<div class="container">
    <center><h1 class="fontbg fonttitle">Ajax Pagination with Search in CodeIgniter </center></h1>
    <br>
    <div class="row text-center fontcolor">
        <div class="post-search-panel">
            <input type="text" id="keywords" placeholder="Type keywords to filter posts" onkeyup="searchFilter()"/> 
            <br>
            <br>
            <select id="sortBy" onchange="searchFilter()">
                <option value="">Sort By</option>
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
        </div>
        <br>
        <div class="post-list" id="postList">
            <?php if(!empty($posts)): foreach($posts as $post): ?>
                <div class="list-item"><a href="javascript:void(0);"><h2><?php echo $post['title']; ?></h2></a></div>
            <?php endforeach; else: ?>
            <p>Post(s) not available.</p>
            <?php endif; ?>
            <?php echo $this->ajax_pagination->create_links(); ?>
        </div>
        <div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/images/loading.gif'; ?>"/></div></div>
    </div>
</div>
</body>
</html>