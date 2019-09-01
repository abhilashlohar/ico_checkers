<?php 
echo 'Dear '.$user_name;
echo '<br><br>';
echo 'Your comment has been rejected.';
echo '<br><br>';
echo '<b>Comment:</b><br/>';
echo $comment;
echo '<br><br>';
echo '<b>News and Articles:</b><br/>';
echo '<a href="https://icocheckers.com/News-and-Articles/'.$news_id.'/'.str_replace(' ', '-', $news_title).'">'.$news_title.'</a>';


