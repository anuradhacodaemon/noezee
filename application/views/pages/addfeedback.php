  <?php
function getBaseUrl() 
{
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF']; 
    
    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
    $pathInfo = pathinfo($currentPath); 
    
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST']; 
    
    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
    
    // return: http://localhost/myproject/
    return $protocol.$hostName.'/neozee/parent';
}

?>

<div class="login-main margintop_74">
    
      <div class="container">
          
        <div class="row">
    
          <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
            <ul class="breadcrumb clearfix">
              <li><a href="<?php echo BASE_URL.'parent/welcome'?>">Home</a></li>
              <li><a href="<?php echo BASE_URL ?>parent/feedback">Feedback</a></li>
              <li class="active">Add New</li>
            </ul>
              
              <div class="login-cont feedback">
              <h1>Feedback</h1>
              
              <form method="POST" action="<?php echo BASE_URL.'parent/feedback/add' ?>">
              <div class = "input-group">
                  <textarea  name="content" required class="form-control"></textarea>
              </div>
              <input type="submit" class="btn btn-primary btn-block margintop_10" value="Send Feedback to Us" />
              </form>
              <div class="divider"><img src="<?php echo BASE_URL; ?>public/web/img/divider.png" alt="Divider" class="img-responsive" /></div>
              <input type="submit" class="btn btn-primary btn-block margintop_10" value="Share NoeZee With Other Parents" />
              <div class="social-sec">
                  
                  
<a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo getBaseUrl() ?>','facebook-share-dialog','width=626,height=436');return false;"><img src="<?php echo BASE_URL; ?>public/web/img/fb.png" alt="Facebook" title="Facebook" class="img-responsive"></a>
                  
                     <a class="twitter-share-button"
  href="https://twitter.com/share"
  data-size="large"
  data-text="custom share text"
  data-url="<?php echo getBaseUrl() ?>"
  data-hashtags="example,demo"
  data-via="twitterdev"
  data-related="twitterapi,twitter" target="_blank"> <img src="<?php echo BASE_URL; ?>public/web/img/tw.png" alt="Twitter" title="Twitter" class="img-responsive"></a>
                <a href="http://pinterest.com/pin/create/button/?url=/node/[nid]&description=[noezee]" target="_blank"><img src="<?php echo BASE_URL; ?>public/web/img/pinterest.png" alt="Pinterest" title="Pinterest" class="img-responsive"></a>
                 <a href="https://plus.google.com/share?url=<?php echo getBaseUrl() ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo BASE_URL; ?>public/web/img/google.png" alt="Googleplus" title="Googleplus" class="img-responsive"></a>
                <a href="<?php echo BASE_URL.'parent/feedback/email'?>"><img src="<?php echo BASE_URL; ?>public/web/img/email.png" alt="Email" title="Email" class="img-responsive"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
