<!-- 
	/**
	* Page Module articles Import from CSV/Excel
	* Plugin pageimportcvsexcel for Cotonti 0.9.26, PHP 8.4+
	* Filename: pageimportcvsexcel.tools.tpl
	* Purpose: Tools Interface
	* Date: Feb 27Th, 2026
	* Source: https://github.com/webitproff/cot-excelimport-PhpSpreadsheet_No-Composer
	* Support: https://abuyfile.com/ru/forums/cotonti/custom/plugs/topic123
	* @package pageimportcvsexcel
	* @version 2.0.1
	* @author webitproff
	* @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
	* @license BSD
	*/ 
-->
<!-- BEGIN: MAIN -->
<div class="container-xll py-4">
	
	<div class="mb-5">{FILE "{PHP.cfg.themes_dir}/admin/{PHP.cfg.admintheme}/warnings.tpl"}</div>
	
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{PHP.L.pageimportcvsexcel_title}</h4>
		</div>
		
        <div class="card-body">
			
			<div class="mb-3">
				{FILE "{PHP.cfg.system_dir}/admin/tpl/warnings.tpl"}
			</div>
            <!-- BEGIN: UPLOAD -->
            <div class="mb-4">
                <h5 class="mb-3">{PHP.L.pageimportcvsexcel_form_upload}</h5>
				
                <form id="uploadForm"
				action="{EXCELIMPORT_FORM_ACTION}"
				method="post"
				enctype="{EXCELIMPORT_FORM_ENCTYPE}">
					
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <tbody>
                                <tr>
                                    <td class="fw-semibold w-25">
                                        {PHP.L.pageimportcvsexcel_select_file}
									</td>
                                    <td>
                                        <input type="file"
										name="excel_file"
										class="form-control"
										accept=".xlsx,.csv"
										required>
									</td>
								</tr>
                                <tr>
                                    <td class="fw-semibold">
                                        {PHP.L.pageimportcvsexcel_max_rows_label}
									</td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {EXCELIMPORT_MAX_ROWS}
										</span>
									</td>
								</tr>
                                <tr>
                                    <td class="fw-semibold">
                                        {PHP.L.pageimportcvsexcel_allowed_formats_label}
									</td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {EXCELIMPORT_ALLOWED_FORMATS}
										</span>
									</td>
								</tr>
                                <tr>
                                    <td colspan="2" class="text-end">
                                        <button type="submit"
										class="btn btn-success px-4">
                                            {PHP.L.pageimportcvsexcel_upload}
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>
			</div>
            <!-- END: UPLOAD -->
			
            <!-- BEGIN: MAPPING -->
            <div class="mb-4">
                <h5 class="mb-2">{PHP.L.pageimportcvsexcel_form_mapping}</h5>
				
                <p class="mb-3">
                    {PHP.L.pageimportcvsexcel_headers}:
                    <span class="badge bg-danger">
                        {EXCELIMPORT_HEADERS}
					</span>
				</p>
				
                <form id="importForm"
				action="{EXCELIMPORT_MAPPING_ACTION}"
				method="post">
					
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="w-50">
                                        {PHP.L.pageimportcvsexcel_field_table}
									</th>
                                    <th>
                                        {PHP.L.pageimportcvsexcel_field_excel}
									</th>
								</tr>
							</thead>
                            <tbody>
                                <!-- BEGIN: FIELDS -->
                                <tr>
                                    <td class="fw-semibold">
                                        {FIELD_LABEL}
									</td>
                                    <td>
                                        {FIELD_INPUT}
									</td>
								</tr>
                                <!-- END: FIELDS -->
							</tbody>
						</table>
					</div>
					
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="submit"
						id="startImport"
						class="btn btn-primary px-4">
                            {PHP.L.pageimportcvsexcel_import}
						</button>
						
                        <a href="{EXCELIMPORT_RESET_URL}"
						class="btn btn-outline-secondary">
                            {PHP.L.pageimportcvsexcel_reset}
						</a>
					</div>
				</form>
			</div>
            <!-- END: MAPPING -->
			
			
		</div>
	</div>
</div>
<!-- END: MAIN -->

