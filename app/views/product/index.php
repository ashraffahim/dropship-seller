<div class="container-fluid">

	<div class="row">
		<div class="col-10 offset-1">
			<table class="table table-theme table-row v-middle">
				<thead>
					<tr>
						<th></th>
						<th style="width: 160px"></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>

					<?php

					if ($data['l'][0]) {
						echo '<tr><td colspan="5" class="bg-transparent"><h3>Drafts</h3></td></tr>';
					}
					foreach($data['l'][0] as $d) { 
						echo '<tr>
								<td></td>
								<td><div class="avatar-group">';

						$i = 0;
						$imgs = glob(DATADIR.DS. 'draft' .DS. $d->id .DS. '*');
						while($i <= 5) {
							if (!isset($imgs[$i])) {
								break;
							}

							echo '<span class="avatar"><img src="' . DATA. '/draft/' . $d->id . '/' . basename($imgs[$i]) . '" class="obj-fit-center w-32 h-32"></span>';
							$i++;
						}

						echo '</div></td>
								<td class="flex">
									' . $d->dp_name . '<small class="text-muted h-1x">' . $d->dp_category . ' §' . $d->dp_price . '</small>
								</td>
								<td>' . sprintf('%04d', number_format($d->id, 2)) . '</td>
								<td class="w-32">
									<a href="/product/edit/' . $d->id . '" class="btn-sm text-muted tr-h-v ajax"><i data-feather="edit-2"></i></a>
								</td>
							</tr>';
					}

					if ($data['l'][1]) {
						echo '<tr><td colspan="5" class="bg-transparent pt-5"><h3>Approved</h3></td></tr>';
					}
					foreach($data['l'][1] as $p) { 
						echo '<tr>
								<td></td>
								<td><div class="avatar-group">';

						$i = 0;
						$imgs = glob(DATADIR.DS. 'product' .DS. $p->id .DS. '*');
						while($i <= 5) {
							if (!isset($imgs[$i])) {
								break;
							}

							echo '<span class="avatar"><img src="' . DATA. '/product/' . $p->id . '/' . basename($imgs[$i]) . '" class="obj-fit-center w-32 h-32"></span>';
							$i++;
						}

						echo '</div></td>
								<td class="flex">
									' . $p->p_name . '<small class="text-muted h-1x">' . $p->p_category . ' §' . $p->p_price . '</small>
								</td>
								<td>' . sprintf('%04d', number_format($p->id, 2)) . '</td>
								<td class="w-32">
									<a href="/product/edit/' . $p->id . '" class="btn-sm text-muted tr-h-v ajax"><i data-feather="edit-2"></i></a>
								</td>
							</tr>';
					}

					?>
				</tbody>
			</table>
		</div>
	</div>
</div>