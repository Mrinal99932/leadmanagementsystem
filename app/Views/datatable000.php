
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>User Datatable</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <div class="mt-3">
     <table class="table table-bordered" id="users-list">
       <thead>
          <tr>
             <th>User Id</th>
             <th>User Name</th>
             <th>Password</th>
			 <th>Role</th>
			 <th>Action</th>
          </tr>
       </thead>
       <tbody>
          <?php if($users): ?>
          <?php foreach($users as $user): ?>
          <tr>
             <td><?php echo $user['user_id']; ?></td>
             <td><?php echo $user['username']; ?></td>
             <td><?php echo $user['password']; ?></td>
			 <td><?php echo $user['role']; ?></td>
			 <td><?php echo"<a href='".base_url()."del/".$user['user_id']."'>Delete</a> | <a href='".base_url()."update/".$user['user_id']."'>Update</a>";?></td>
          </tr>
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
     </table>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
      $('#users-list').DataTable();
  } );
</script>
<a href="<?php echo base_url();?>resume"><h4>Dashboard</h4></a>
</body>
</html>