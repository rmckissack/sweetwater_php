<?php 


require_once('db_connection.php');
require_once('query_comments.php');
$db = db_connect();

?>

<!doctype html>

<html lang="en">
  <head>
    <title>Sweetwater Code Test</title>
    <meta charset="utf-8">
    </head>

  <body>
    
<h2>Display comments that mention "candy" in them</h2>
    <table>
  	  <tr>
        <th>Order ID</th>
        <th>Comments</th>
        <th>Ship Date Expected</th>
        </tr>

      <?php 

      $candy_comment = query_comments("candy");
      while($record = mysqli_fetch_assoc($candy_comment)) { ?>
        <tr>
          <td><?php echo $record['orderid']; ?></td>
          <td><?php echo $record['comments']; ?></td>
          <td><?php echo $record['shipdate_expected']; ?></td>

        </tr>
      <?php } ?>
  	</table>

      <h2>Display comments that mention "call" in them</h2>
    <table>
  	  <tr>
        <th>Order ID</th>
        <th>Comments</th>
        <th>Ship Date Expected</th>
        </tr>

      <?php 
      $call_comment = query_comments("call");
      while($record = mysqli_fetch_assoc($call_comment)) { ?>
        <tr>
          <td><?php echo $record['orderid']; ?></td>
          <td><?php echo $record['comments']; ?></td>
          <td><?php echo $record['shipdate_expected']; ?></td>

        </tr>
      <?php } ?>
  	</table>

      <h2>Display comments that mention being "referred" by someone in them</h2>
    <table>
  	  <tr>
        <th>Order ID</th>
        <th>Comments</th>
        <th>Ship Date Expected</th>
        </tr>

      <?php 
      $referred_comment = query_comments("referred");
      while($record = mysqli_fetch_assoc($referred_comment)) { ?>
        <tr>
          <td><?php echo $record['orderid']; ?></td>
          <td><?php echo $record['comments']; ?></td>
          <td><?php echo $record['shipdate_expected']; ?></td>

        </tr>
      <?php } ?>
  	</table>

      <h2>Display comments that mention "signature" in them</h2>
    <table>
  	  <tr>
        <th>Order ID</th>
        <th>Comments</th>
        <th>Ship Date Expected</th>
        </tr>

      <?php 
      $signature_comment = query_comments("signature");
      while($record = mysqli_fetch_assoc($signature_comment)) { ?>
        <tr>
          <td><?php echo $record['orderid']; ?></td>
          <td><?php echo $record['comments']; ?></td>
          <td><?php echo $record['shipdate_expected']; ?></td>

        </tr>
      <?php } ?>
  	</table>
    
     



      <?php 
      $all_comment = query_all_comments();
      while($record = mysqli_fetch_assoc($all_comment)) {

     // If comments contains 'Expected Ship Date:' do the following
      if(strpos($record['comments'], 'Expected Ship Date:') !== false ) {
        // pull the date from the end of the contents string
        $pulled_date=substr($record['comments'], -9);
        // change the date to have a 4 digit year
        $full_year = str_replace('/', '-', substr_replace($pulled_date, "20", 6, 0));
        // rearrange the date for correct database format
        $year_first = date('Y-d-m', strtotime($full_year));
        // Remove 'Expected Ship Date: XX/XX/XX' from end of comment string
        $new_comment = substr($record['comments'], 0, -29);
        //Call function to update record
        set_date($record['orderid'], $year_first, $new_comment);
       // I would rather have done this using regular expressions but due to time it would have taken me to brush up on that subject I didn't use them.
       // This will cause problems when the comment is not formatted correctly.
      }
    } ?>
  	</table>

    <h2>Display all comments showing the date moved to the shipdate_expected column</h2>
    <table>
  	  <tr>
        <th>Order ID</th>
        <th>Comments</th>
        <th>Ship Date Expected</th>
        </tr>

      <?php 
      $all_comment = query_all_comments();
      while($record = mysqli_fetch_assoc($all_comment)) {
        echo ("<tr>");
          echo("<td>" . $record['orderid'] . "</td>");
          echo("<td>" . $record['comments'] . "</td>");
          echo("<td>" . $record['shipdate_expected'] . "</td>");

        echo("</tr>");
      }
    ?>
  	</table> 

</body>
</html>

<?php
  db_disconnect($db);
?>