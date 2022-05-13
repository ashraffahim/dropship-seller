<?php echo pageTitle(['Product', 'Index', 'fa fa-list fa-lg']); ?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body shadow-sm">
				<table class="table table-light table-striped table-lg">
					<thead>
						<th></th>
						<th>Name</th>
						<th>Price</th>
						<th>Summ.</th>
						<th>Brand</th>
						<th>Model</th>
						<th>Status</th>
						<th></th>
					</thead>
					<tbody>
					<?php
					$i = 0;
					foreach ($data['data'] as $p) {
						$i++;
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $p->dp_name; ?><br><i class="text-muted"><?php echo $p->dp_category; ?></i></td>
							<td><?php echo $p->dp_price; ?></td>
							<td><?php echo $p->dp_description; ?></td>
							<td><?php echo $p->dp_brand; ?></td>
							<td><?php echo $p->dp_model; ?></td>
							<td><?php echo $p->dp_status; ?></td>
							<td>.</td>
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>