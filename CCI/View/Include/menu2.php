  
                        
                        <li <?php if(PageKey::$PAGE_HOME == $pageKey){ echo 'class="active"'; } ?>>
                            <a href="#"><span class="badge pull-right"></span> Home</a>
                        </li>
                         
                          <li>
                             <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                                 <li <?php if(PageKey::$PAGE_SHORTCODE == $pageKey){ echo 'class="active"'; } ?>><a href="../Shortcode">Service</a></li>
                                 <li <?php if(PageKey::$PAGE_SERVICE == $pageKey){ echo 'class="active"'; } ?> ><a href="../Service/">  Sub Service</a></li>
                                 <li <?php if(PageKey::$PAGE_SERVICE_TYPE == $pageKey){ echo 'class="active"'; } ?>><a href="../ServiceType/"> Service Type</a></li>
                                 <li <?php if(PageKey::$TRANSC == $pageKey){ echo 'class="active"'; } ?>><a href="../Trans/"> Transc</a></li>
                                 <li <?php if(PageKey::$SMPP == $pageKey){ echo 'class="active"'; } ?>><a href="../SMPP/"> SMPP</a></li>
                                 <li <?php if(PageKey::$COMPANY == $pageKey){ echo 'class="active"'; } ?>><a href="../Company/"> Company</a></li>
                                 <li <?php if(PageKey::$COUNTRY == $pageKey){ echo 'class="active"'; } ?>><a href="../Country/">Country</a></li>
                                 <li <?php if(PageKey::$PAGE_USER == $pageKey){ echo 'class="active"'; } ?>><a href="../User/"> User Setting</a></li>
                                 <li <?php if(PageKey::$SYSTEM_MESSAGE == $pageKey){ echo 'class="active"'; } ?>><a href="../SystemMessage/"> System Messages</a></li>
                            </ul>
                          </li>
                        
                         
                        
                        <li <?php if(PageKey::$PAGE_Bulk == $pageKey){ echo 'class="active"'; } ?>>
                             <a href="../Bulk/register_customer.php">  Bulk Subscription</a>
                        </li>
                        
                        <li <?php if(PageKey::$UN_SUBSCRIBE == $pageKey){ echo 'class="active"'; } ?>>
                              <a href="../Subscriber/un_subscribe.php">  Un Subscribe</a>
                        </li>
                        
                        
                       