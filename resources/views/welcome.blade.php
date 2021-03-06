<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>QBO Test</title>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-light bg-light">
        <?php if(!$accessToken):?>
        <button class="btn btn-outline-success" type="button" onclick="location.href='<?=$qbo->getAuthUrl();?>'">AUTHORIZE</button>
        <?php else:?>
        <div class="row">
            <div class="col">
                <p>Authorized</p>
            </div>
            <div class="col-12" style="margin-bottom: 20px;">
                <ul class="list-group">
                    <li class="list-group-item">Realm ID: <?=$accessToken->getRealmID()?></li>
                </ul>

            </div>
            <div class="col-12">
                <button class="btn btn-outline-success" type="button" onclick="location.href='/new_invoice'">Create Random Invoice</button>
                <div><?=$amount?"Invoice with amount " . $amount . ' created. You can check it in QBO sandbox account.':"";?></div>

            </div>
        </div>
        <?if($employee):?>
        <div class="row">
            <div class="col-12">
                <p>Employee List</p>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Phone Number</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($employee as $person):?>
                <tr>
                    <td><?php echo $person->GivenName;?></td>
                    <td><?php echo $person->FamilyName;?></td>
                    <td><?php echo $person->PrimaryPhone->FreeFormNumber;?></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?endif;?>
        <?php endif;?>
    </nav>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>