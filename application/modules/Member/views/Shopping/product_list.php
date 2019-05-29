<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Shopping 
            <small>Shopping Products</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>
    <section class="content container-fluid">
        <div class="row">
            <?php
            foreach ($products as $key => $product) {
                ?>
            <div class="col-md-3" style="border:2px solid greenyellow; margin: 20px;">
                    <img src="<?php echo base_url('uploads/' . $product['image']); ?>" width="100%"> <br>
                    <h2>Price : <?php echo $product['price']; ?></h2><br>
                    <b><?php echo $product['discount']; ?>% off</b>
                    <button class="btn btn-primary pull-right">Add to Cart</button>
                </div>
                <?php
            }
            ?>

        </div>
    </section>
</div>