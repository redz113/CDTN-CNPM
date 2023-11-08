<main>
    <?php
            if(isset($_GET['quanly'])){
                $tam = $_GET['quanly'];
                if($tam == "about"){
                    include("main/about.php");
                }else if($tam == "courses"){ 
                    include("main/course.php");
                }else if($tam == "coursedetail"){
                    include("main/detail.php");
                }else if($tam == "ourfeatures"){
                    include("main/feature.php");
                }else if($tam == "instructors"){
                    include("main/team.php");
                }else if($tam == "testimonial"){
                    include("main/testimonial.php");
                }else if($tam == "contact"){
                    include("main/contact.php");
                }
            }else{
                $tam = '';
                include("main/index.php");
            }
            
        ?>  
</main>