<div class="page-hero page-container " id="page-hero">
	<div class="padding d-flex">
		<div class="page-title">
			<h2 class="text-md text-highlight"><span class="text-muted">Assign Items / </span> <?php echo $data['qs']->q_title; ?></h2>
			<small class="text-muted"><?php echo $data['qs']->q_description; ?></small>
			<small class="text-muted d-flex align-items-center"><i data-feather="clock" height="12" width="12"></i> <i class="ml-1"><?php echo date('d M, Y h:i A', $data['qs']->q_timestamp); ?></i></small>
		</div>
		<div class="flex"></div>
		<div>
			<button type="button" id="pam" class="btn btn-wave btn-primary text-white" disabled>
				<span class="d-none d-sm-inline mx-1">Publish</span>
				<i data-feather="arrow-right"></i>
			</button>
		</div>
	</div>
</div>

<div class="container-fluid" data-plugin="menu_assign" data-option="{}">
	
	<!-- Toolbar -->
	<div class="row">

		<!-- Filter assignable list -->

		<div class="col-6">
			<div class="toolbar mb-5">
				<div class="btn-group">
					<button class="btn btn-sm btn-icon btn-white" data-toggle="tooltip" title="" id="btn-trash" data-original-title="Trash"><i data-feather="trash"></i></button>
					<button class="btn btn-sm btn-icon btn-white sort" data-sort="item-title" data-toggle="tooltip" title="" data-original-title="Sort"><i class="sorting"></i></button>
				</div>
				<div class="input-group">
					<input type="text" class="form-control form-control-theme form-control-sm search" placeholder="Search" required="" autocomplete="off">
					<span class="input-group-append">
						<span class="btn btn-white no-border btn-sm">
							<span class="d-flex text-muted"><i data-feather="search"></i></span>
						</span>
					</span>
				</div>
			</div>
		</div>

		<!-- Actions on assigned items -->

		<div class="col-6">
			<div class="toolbar mb-5">
				<div class="btn-group">
					<button class="btn btn-sm btn-white cai">Collapse</button>
					<button class="btn btn-sm btn-white eai">Expand</button>
				</div>
				<div class="input-group">
					<input type="text" class="form-control form-control-theme form-control-sm search" placeholder="Search" required="" autocomplete="off">
					<span class="input-group-append">
						<button class="btn btn-white no-border btn-sm" type="button">
							<span class="d-flex text-muted"><i data-feather="search"></i></span>
						</button>
					</span>
				</div>
			</div>
		</div>

	</div>

	<?php if (isset($data['status']['alrt'])) : ?>
	<div class="row">
		<div class="col-12">
			<div class="d-flex align-items-center alert alert-<?php echo $data['status']['alrt']['t']; ?>">
				<?php echo $data['status']['alrt']['b']; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>


	<!-- Assignment Content -->
	<div class="row" data-plugin="sort">

		<!-- Products -->
		<div class="col-6">
			

			<?php

			/*
			Load product list available for assignment
			Check assigned boxes
			*/

			$g = '';
			foreach ($data['ms'] as $i => $p) {
				if ($g != $p->p_group) {
					$g = $p->p_group;

					if ($i > 0) {
						echo '</tbody></table>';
					}

					echo '<table class="table table-theme pl" data-group="' . str_replace(' ', '_', $p->p_group) . '">
							<thead>
								<tr class="text-muted">
									<th style="width: 20px;"></th>
									<th colspan="3">' . $p->p_group . '</th>
								</tr>
							</thead>
							<tbody>';
				}

				if ((bool)$p->p_status) {
					echo '<tr class="' . $p->chkd_color . '">
							<td><label class="md-check"><input type="checkbox" class="atm" data-id="' . $p->id . '"' . $p->chkd . '><i></i></label></td>';
				} else {
					echo '<tr class="text-muted">
							<td><span data-toggle="tooltip" title="Hidden"><i class="text-light" data-feather="eye-off"></i></span></td>';
				}

				echo '
						<td style="width: 40%">' . $p->p_name . '</td>
						<td style="width: 40%">' . $p->p_description . '</td>
						<td>' . $p->p_price . '</td>
					</tr>';
			}
			?>

			<!-- Close final table tag -->
			</tbody></table>
			<!-- Close final table tag -->
		</div>

		<!-- Menu -->
		<div class="col-6" id="menuContainer">
			<form method="post" class="flex" class="sortable">
				<?php

				/*
				Load product list available for assignment
				Check assigned boxes
				*/

				$g = '';
				foreach ($data['ms'] as $i => $p) {
					
					if ($p->m_pid == '') {
						continue;
					}

					if ($g != $p->p_group) {
						$g = $p->p_group;

						if ($i > 0) {
							echo '</tbody></table>';
						}

						echo '<table id="g' . str_replace(' ', '_', $p->p_group) . '" class="table table-theme c-grab">
								<thead>
									<tr class="text-muted">
										<th style="width: 20px;"></th>
										<th colspan="4">' . $p->p_group . '</th>
									</tr>
								</thead>
								<tbody class="sortable-table">';
					}

					echo '<tr id="pd' . $p->id . '">
							<td>
								<input type="hidden" name="pid[]" value="' . $p->id . '">
								' . (!$p->p_status ? '<b class="badge-circle xs text-danger"></b>' : '') . '
							</td>
							<td style="width: 40%">' . $p->p_name . '</td>
							<td style="width: 40%">' . $p->p_description . '</td>
							<td>' . $p->p_price . '</td>
							<td><a class="btn btn-wave btn-outline-light btn-xs rounded-pill text-muted tr-h-v"><i data-feather="plus"></i> Label</a></td>
						</tr>';
				}
				?>

				<!-- Close final table tag -->
				</tbody></table>
				<!-- Close final table tag -->
			</form>
		</div>
	</div>
</div>