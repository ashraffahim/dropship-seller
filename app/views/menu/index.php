<div class="container-fluid">
	<div class="row">
		<div class="col-10 offset-1">
			<table class="table table-theme table-row v-middle">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($data['qs'] as $q) {
						echo '<tr>
								<td></td>
								<td><a href="/menu/assign/' . $q->id . '" class="ajax flex">
									<big>' . $q->q_title . '</big><small class="text-muted h-1x">' . $q->q_description . '</small>
								</a></td>
								<td></td>
								<td></td>
								<td class="text-right">
									<a class="btn-sm tr-h-v text-muted ajax"><i data-feather="grid"></i></a>
									<a class="btn-sm tr-h-v text-muted ajax"><i data-feather="edit-2"></i></a>
								</td>
							</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>