<div class='content'>
<?php

$component = new OssnComponents;
$settings  = $component->getSettings('RssFeed');
$url = "$settings->rss_html";
        
$invalidurl = false;
        if(@simplexml_load_file($url)){
            $feeds = simplexml_load_file($url);
        }else{
            $invalidurl = true;
            echo "<h4>Invalid RSS feed URL</h4>";
        }


        $i=0;
        if(!empty($feeds)){


            $site = $feeds->channel->title;
            $sitelink = $feeds->channel->link;

            echo "<div class='post-head'>".$site."</div>";
            foreach ($feeds->channel->item as $item) {

                $title = $item->title;
                $link = $item->link;
                $description = $item->description;
                $postDate = $item->pubDate;
                $pubDate = date('D, d M Y',strtotime($postDate));


                if($i>=5) break;
        ?>
                    <div class="post-content">
                        <span><?php echo $pubDate; ?></span>
                        <h4><a class="feed_title" href="<?php echo $link; ?>"><?php echo $title; ?></a></h4>
						<?php echo implode(' ', array_slice(explode(' ', $description), 0, 20)) . "..."; ?> <a href="<?php echo $link; ?>"><?php echo ossn_print('com_rssfeed:readmore'); ?></a>
                    </div>
                

                <?php
                $i++;
            }
        }else{
            if(!$invalidurl){
                echo "<h4>No items found</h4>";
            }
        }
    ?>
</div>	