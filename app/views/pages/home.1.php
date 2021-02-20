<div class="page-wrap d-flex flex-row align-items-center">
        <div class="container" style="padding-bottom:20px;">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    
                    <?php if(count($levels) > 1) { ?>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?p=<?php echo $p;?>">Home</a></li>
                        <?php echo $breadcrumb;?>
                      </ol>
                    </nav>
                    <?php } ?>
                
                </div>
                <?php foreach($entries as $entry) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                    
                    <?php if(is_dir($currDirectory.$entry)) { ?>

                        <div class="card mt-2" style="overflow:hidden;">
                          <a class="" style="text-decoration: none;" href="<?php echo '/?p='.$p.'&d='.urlencode($d.$entry); ?>">
                          
                            <div style="overflow:hidden;">
                              <img class="card-img-top p-4"  src="<?php echo '/?p=thumbnail&f=folder.png'; ?>">
                              <h4><?php echo ucwords(str_replace('-', ' ', $entry)); ?></h4>
                            </div>
                          
                          </a>
                        </div>
                        
                    <?php } else { ?>
                            
                            <div class="card mt-2" style="overflow:hidden;">
                              <a class="" style="text-decoration: none;" href="<?php echo '/?p=get&f='.urlencode($d.$entry).''; ?>">
                                <div style="overflow:hidden;">
                                  <img class="card-img-top p-4"  src="<?php echo '/?p=thumbnail&f='.urlencode($d.$entry).''; ?>">
                                  <h4><?php echo ucwords(str_replace('-', ' ', $entry)); ?></h4>
                                </div>
                              </a>
                            </div>
                            
                            
                            
                
                    <?php } ?>
                    
                    
                </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
    