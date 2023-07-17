function direct_post(){
    window.location.href = "http://localhost:3000/post.php";
}

function direct_settings(){
    window.location.href = "http://localhost:3000/profile.php";
}

function direct_export(){
    window.location.href = "http://localhost:3000/export.php";
}

function direct_main(){
    window.location.href = "http://localhost:3000/posts.php";
}

function search(){
    window.location.href = "http://localhost:3000/search.php";
}

function delete_acc(){
    window.location.href = "http://localhost:3000/delete.php";
}

function logout(){
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var cookieName = cookie.split("=")[0];
        document.cookie = cookieName + "=;  path=/";
    }

    window.location.href = "http://localhost:3000/signup.php";
}