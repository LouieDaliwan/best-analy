<?php
$data = array(
  array(
    "label"=> "GROSS MARGIN",
    "description"=> "Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae veritatis id cum mollitia officia nobis necessitatibus maiores natus.",
  ),
  array(
    "label"=> "NET MARGIN AFTER TAX",
    "description"=> "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
  ),
  array(
    "label"=> "CURRENT RATIO",
    "description"=> "Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae veritatis id cum mollitia officia nobis necessitatibus maiores natus. Asperiores omnis excepturi dicta dolorum error voluptate. Doloribus corrupti quae soluta beatae.",
  ),
  array(
    "label"=> "DEBT RATIO",
    "description"=> "Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae veritatis id cum mollitia officia nobis necessitatibus maiores natus. Asperiores omnis excepturi dicta dolorum error voluptate. Doloribus corrupti quae soluta beatae.",
  ),
  array(
    "label"=> "ROI",
    "description"=> "Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae veritatis id cum mollitia officia nobis necessitatibus maiores natus. Asperiores omnis excepturi dicta dolorum error voluptate.",
  ),
  array(
    "label"=> "RAW MATERIALS MARGIN",
    "description"=> "Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae veritatis id cum mollitia officia nobis necessitatibus maiores natus.",
  ),
);  
?>

<div class="row">
  @foreach($data as $value)
    <div class="col-6">
      <div class="py-1 px-2" style="background-color: rgba(0,0,0,0.3); font-weight: bold"><?= $value['label']; ?></div>

      <div class="mb-3 w-100" style="height: 200px; background-color: grey; opacity: .1;"></div>

      <p><?= $value['description']; ?></p>
    </div>
  @endforeach
</div>