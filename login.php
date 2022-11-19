<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Realtime Chat App</header>
            <form action="#">
                <div class="error-txt"></div>
                <div class="field input">
                    <label>Email address</label>
                    <input type="text" placeholder="Enter Your Email" name="email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" placeholder="Enter Your Password" name="password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Not Yet Signed Up? <a href="index.php">Signup Now</a></div>
        </section>
    </div> 
    <script src="JavaScript/pass-show-hide.js"></script>
    <script src="JavaScript/login.js"></script>

    
</body>
</html>