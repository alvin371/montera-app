<div class="form-message"></div>

<!-- Export Preview Section -->
<div class="alert alert-info" id="export-preview" style="display:none;">
	<div class="d-flex justify-content-between align-items-center">
		<div>
			<strong id="preview-count">0 records</strong> will be exported
			<br><small id="preview-date-range"></small>
			<div id="preview-filters" class="mt-2"></div>
		</div>
		<div>
			<i class="bi bi-info-circle fs-20"></i>
		</div>
	</div>
</div>

<!-- Filter Form -->
<form action="<?= base_url() ?>/transaction/download-process" method="POST" id="form-modal">

	<div class="row">
		<!-- Date Range Section -->
		<div class="col-md-12 mb-3">
			<h6 class="mb-2"><i class="bi bi-calendar-range"></i> Rentang Tanggal</h6>
			<div class="row">
				<div class="col-md-12 mb-2">
					<!-- Quick Date Preset Buttons -->
					<div class="btn-group btn-group-sm" role="group">
						<button type="button" class="btn btn-outline-secondary" onclick="setDatePreset('today')">Hari Ini</button>
						<button type="button" class="btn btn-outline-secondary" onclick="setDatePreset('last7days')">7 Hari Terakhir</button>
						<button type="button" class="btn btn-outline-secondary" onclick="setDatePreset('last30days')">30 Hari Terakhir</button>
						<button type="button" class="btn btn-outline-secondary" onclick="setDatePreset('thismonth')">Bulan Ini</button>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<label class="mb-2">Tanggal Mulai</label>
					<input type="date" name="start_date" id="start_date" class="form-control" value="<?= DATE('Y-m-01') ?>" required>
				</div>
				<div class="col-12 col-md-6">
					<label class="mb-2">Tanggal Akhir</label>
					<input type="date" name="until_date" id="until_date" class="form-control" value="<?= DATE('Y-m-d') ?>" required>
				</div>
			</div>
		</div>

		<!-- Brand & Marketplace Filters -->
		<div class="col-12 col-md-6 mb-3">
			<label class="mb-2"><i class="bi bi-tag"></i> Brand</label>
			<select name="brand" id="brand" class="form-control form-select">
				<option value="">Semua Brand</option>
				<?php foreach ($brands as $brand): ?>
					<option value="<?= $brand['code'] ?>"><?= $brand['name'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="col-12 col-md-6 mb-3">
			<label class="mb-2"><i class="bi bi-shop"></i> Marketplace</label>
			<select name="marketplace" id="marketplace" class="form-control form-select">
				<option value="">Semua Marketplace</option>
				<?php foreach ($marketplaces as $mkt): ?>
					<option value="<?= $mkt['name'] ?>"><?= $mkt['name'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<!-- Order Status Filter -->
		<div class="col-md-12 mb-3">
			<label class="mb-2"><i class="bi bi-check-circle"></i> Status Order</label>
			<div class="row g-3 mx-5">
				<div class="col-6 col-lg-3">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="order_status" id="status_all" value="" checked>
						<label class="form-check-label" for="status_all">Semua Status</label>
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="order_status" id="status_active" value="ACTIVE">
						<label class="form-check-label" for="status_active">Active</label>
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="order_status" id="status_rts" value="READY_TO_SHIP">
						<label class="form-check-label" for="status_rts">Ready to Ship</label>
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="order_status" id="status_completed" value="COMPLETED">
						<label class="form-check-label" for="status_completed">Completed</label>
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="order_status" id="status_cancelled" value="CANCELLED">
						<label class="form-check-label" for="status_cancelled">Cancelled</label>
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="order_status" id="status_return" value="RETURN">
						<label class="form-check-label" for="status_return">Return</label>
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="order_status" id="status_unpaid" value="UNPAID">
						<label class="form-check-label" for="status_unpaid">Unpaid</label>
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="order_status" id="status_settlement" value="SETTLEMENT">
						<label class="form-check-label" for="status_settlement">Settlement</label>
					</div>
				</div>
			</div>
		</div>

		<!-- CS & Shipping Filter -->
		<div class="col-12 col-md-6 mb-3">
			<label class="mb-2"><i class="bi bi-person"></i> Customer Service</label>
			<select name="cs" id="cs" class="form-control form-select">
				<option value="">Semua CS</option>
				<?php foreach ($cs_list as $cs_item): ?>
					<option value="<?= $cs_item['code'] ?>"><?= $cs_item['full_name'] ?> (<?= $cs_item['code'] ?>)</option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="col-12 col-md-6 mb-3">
			<label class="mb-2"><i class="bi bi-truck"></i> Ekspedisi</label>
			<select name="ekspedisi" id="ekspedisi" class="form-control form-select">
				<option value="">Semua Ekspedisi</option>
				<?php foreach ($shipping_list as $ship): ?>
					<option value="<?= $ship['name'] ?>"><?= $ship['name'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<!-- Order Type Filter -->
		<div class="col-md-12 mb-3">
			<label class="mb-2"><i class="bi bi-tag"></i> Tipe Order</label>
			<div class="row g-3 mx-5">
				<div class="col-6 col-lg-4">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="order_type" id="type_all" value="" checked>
						<label class="form-check-label" for="type_all">Semua</label>
					</div>
				</div>
				<div class="col-6 col-lg-4">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="order_type" id="type_manual" value="Manual">
						<label class="form-check-label" for="type_manual">Manual</label>
					</div>
				</div>
				<div class="col-6 col-lg-4">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="order_type" id="type_marketplace" value="Marketplace">
						<label class="form-check-label" for="type_marketplace">Marketplace</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Action Buttons -->
	<div class="col-12 mt-3 mb-3">
		<div class="d-flex flex-wrap gap-2">
			<button type="submit" class="btn btn-primary btn-send">
				<i class="bi bi-download"></i> Download Excel Sekarang
			</button>
			<button type="button" class="btn btn-secondary" onclick="updatePreview()">
				<i class="bi bi-eye"></i> Lihat Preview
			</button>
		</div>
	</div>

	<!-- File History Section -->
	<div class="col-md-12 mt-4">
		<hr>
		<h6 class="mb-2"><i class="bi bi-clock-history"></i> Riwayat Download (10 Terakhir)</h6>
		<div id="div-download"></div>
	</div>
</form>

<script type="text/javascript">
	// Date preset functions
	function setDatePreset(preset) {
		const today = new Date();
		let startDate, endDate;

		switch (preset) {
			case 'today':
				startDate = endDate = today;
				break;
			case 'last7days':
				startDate = new Date(today);
				startDate.setDate(today.getDate() - 7);
				endDate = today;
				break;
			case 'last30days':
				startDate = new Date(today);
				startDate.setDate(today.getDate() - 30);
				endDate = today;
				break;
			case 'thismonth':
				startDate = new Date(today.getFullYear(), today.getMonth(), 1);
				endDate = today;
				break;
		}

		// Update date input values
		document.getElementById('start_date').value = formatDate(startDate);
		document.getElementById('until_date').value = formatDate(endDate);

		// Debug: Log the new date values
		console.log('Date preset applied:', preset);
		console.log('New start_date:', formatDate(startDate));
		console.log('New until_date:', formatDate(endDate));

		// Trigger change event which will automatically call updatePreview via the debounced listener
		$('#start_date').trigger('change');
	}

	function formatDate(date) {
		const year = date.getFullYear();
		const month = String(date.getMonth() + 1).padStart(2, '0');
		const day = String(date.getDate()).padStart(2, '0');
		return `${year}-${month}-${day}`;
	}

	// Update preview
	function updatePreview() {
		const formData = new FormData(document.getElementById('form-modal'));
		const params = new URLSearchParams(formData).toString();

		// Debug: Log the parameters being sent
		console.log('Updating preview with params:', params);
		console.log('Start date:', $('#start_date').val());
		console.log('Until date:', $('#until_date').val());

		// Show loading state
		$('#export-preview').show();
		$('#preview-count').html('<i class="bi bi-arrow-repeat spin"></i> Loading...');
		$('#preview-date-range').text('');
		$('#preview-filters').html('');

		$.ajax({
			type: 'GET',
			url: "<?= base_url() ?>/transaction/download-preview?" + params,
			dataType: 'json',
			cache: false,
			success: function(data) {
				console.log('Preview data received:', data);
				if (data.success) {
					$('#preview-count').text(data.total_records + ' records');
					$('#preview-date-range').text('Periode: ' + data.date_range);

					if (data.filters && data.filters.length > 0) {
						let filtersHtml = '<small><strong>Filter aktif:</strong> ' + data.filters.join(', ') + '</small>';
						$('#preview-filters').html(filtersHtml);
					} else {
						$('#preview-filters').html('');
					}

					$('#export-preview').slideDown();
				} else {
					$('#preview-count').text('Error loading preview');
					$('#preview-date-range').text('');
				}
			},
			error: function(xhr, status, error) {
				console.error('Preview error:', error);
				console.error('XHR response:', xhr.responseText);
				$('#preview-count').text('Error loading preview');
				$('#preview-date-range').text('');
			}
		});
	}

	// Load download history
	function loadDownload() {
		$.ajax({
			type: 'GET',
			url: "<?= base_url() ?>/transaction/download-ajax",
			success: function(data) {
				$('#div-download').html(data.html);
			},
			error: function(xhr, status, error) {
				console.error('Load download error:', error);
			}
		});
	}

	// Auto-update preview when filters change (with debouncing to prevent multiple calls)
	let previewTimeout;
	$('#form-modal input, #form-modal select').on('change', function() {
		clearTimeout(previewTimeout);
		previewTimeout = setTimeout(function() {
			updatePreview();
		}, 100);
	});

	// Initialize
	$(document).ready(function() {
		updatePreview();
		loadDownload();
		setInterval(loadDownload, 10000); // Check every 10 seconds
	});

	// Form submission for direct download
	$("#form-modal").submit(function(e) {
		e.preventDefault();

		var form = $(this);

		// Explicitly capture all form field values to ensure radio buttons are captured correctly
		var formValues = {
			start_date: $('#start_date').val(),
			until_date: $('#until_date').val(),
			brand: $('#brand').val(),
			marketplace: $('#marketplace').val(),
			cs: $('#cs').val(),
			ekspedisi: $('#ekspedisi').val(),
			order_status: $('input[name="order_status"]:checked').val() || '',
			order_type: $('input[name="order_type"]:checked').val() || ''
		};

		// Debug: Log form data being submitted
		console.log('=== FORM SUBMISSION DEBUG ===');
		console.log('Form values being submitted:', formValues);
		console.log('Filters applied:');
		if (formValues.brand) console.log('  - Brand:', formValues.brand);
		if (formValues.marketplace) console.log('  - Marketplace:', formValues.marketplace);
		if (formValues.cs) console.log('  - CS:', formValues.cs);
		if (formValues.ekspedisi) console.log('  - Ekspedisi:', formValues.ekspedisi);
		if (formValues.order_status) console.log('  - Order Status:', formValues.order_status);
		if (formValues.order_type) console.log('  - Order Type:', formValues.order_type);
		console.log('=== END DEBUG ===');

		// Create a temporary form to submit and trigger download
		var tempForm = $('<form>', {
			'action': form.attr('action'),
			'method': 'POST',
			'target': '_blank'
		});

		// Add each value as hidden input
		$.each(formValues, function(name, value) {
			tempForm.append($('<input>', {
				'type': 'hidden',
				'name': name,
				'value': value
			}));
		});

		// Append to body, submit, and remove
		tempForm.appendTo('body').submit().remove();

		// Show success message
		$(".form-message").hide().html(
			'<div class="alert alert-success"><i class="bi bi-check-circle"></i> File Excel sedang diunduh... Cek folder download Anda!</div>'
		).slideDown("fast");

		// Hide message after 5 seconds
		setTimeout(function() {
			$(".form-message").slideUp();
		}, 5000);

		return false;
	});
</script>

<style>
	#export-preview {
		border-left: 4px solid #0d6efd;
		margin-bottom: 20px;
	}

	.form-check {
		padding: 0.375rem 0;
		margin-bottom: 0;
	}

	.form-check-input {
		margin-top: 0.25rem;
	}

	.form-check-label {
		margin-left: 0.5rem;
		cursor: pointer;
	}

	label {
		font-weight: 500;
		color: #495057;
	}

	.btn-group-sm .btn {
		font-size: 0.875rem;
		padding: 0.25rem 0.5rem;
	}

	.form-control,
	.form-select {
		border-radius: 0.375rem;
	}

	.d-flex.gap-2>* {
		margin-right: 0.5rem;
	}

	.d-flex.gap-2>*:last-child {
		margin-right: 0;
	}

	/* Better spacing for mobile */
	@media (max-width: 767.98px) {
		.form-check {
			padding: 0.5rem 0;
		}
	}

	.loading-ellipsis {
		display: inline-block;
		position: relative;
		width: 64px;
		height: 16px;
	}

	.loading-ellipsis div {
		position: absolute;
		top: 6px;
		width: 8px;
		height: 8px;
		border-radius: 50%;
		background: #fff;
		animation-timing-function: cubic-bezier(0, 1, 1, 0);
	}

	.loading-ellipsis div:nth-child(1) {
		left: 6px;
		animation: loading-ellipsis1 0.6s infinite;
	}

	.loading-ellipsis div:nth-child(2) {
		left: 6px;
		animation: loading-ellipsis2 0.6s infinite;
	}

	.loading-ellipsis div:nth-child(3) {
		left: 24px;
		animation: loading-ellipsis2 0.6s infinite;
	}

	.loading-ellipsis div:nth-child(4) {
		left: 42px;
		animation: loading-ellipsis3 0.6s infinite;
	}

	@keyframes loading-ellipsis1 {
		0% {
			transform: scale(0);
		}

		100% {
			transform: scale(1);
		}
	}

	@keyframes loading-ellipsis3 {
		0% {
			transform: scale(1);
		}

		100% {
			transform: scale(0);
		}
	}

	@keyframes loading-ellipsis2 {
		0% {
			transform: translate(0, 0);
		}

		100% {
			transform: translate(18px, 0);
		}
	}

	/* Spinning animation for loading icon */
	@keyframes spin {
		0% {
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(360deg);
		}
	}

	.spin {
		animation: spin 1s linear infinite;
		display: inline-block;
	}
</style>