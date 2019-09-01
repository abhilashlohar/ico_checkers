<?php 
echo 'Dear '.$user_name;
echo '<br><br>';
echo 'Your comment has been approved.';
echo '<br><br>';
echo '<b>Comment:</b><br/>';
echo $comment;
echo '<br><br>';
echo '<b>News and Articles:</b><br/>';
echo '<a href="http://localhost/ico_checkers/News-and-Articles/'.$news_id.'/'.str_replace(' ', '-', $news_title).'">'.$news_title.'</a>';


