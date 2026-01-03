
<style>
  .lp-card {
    border-radius: 2px;
    border: 1px solid #f0f0f0;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.09);
    margin-bottom: 16px;
  }

  .lp-card-header {
    background-color: #fff;
    border-bottom: 1px solid #f0f0f0;
    padding: 16px;
  }

  .lp-card-body {
    padding: 16px;
  }

  .lp-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border: 1px solid #f0f0f0;
    border-radius: 2px;
  }

  .lp-table thead th {
    background-color: #fafafa;
    color: rgba(0, 0, 0, 0.85);
    font-weight: 500;
    text-align: left;
    padding: 12px 8px;
    font-size: 14px;
    border-bottom: 1px solid #f0f0f0;
  }

  .lp-table tbody td {
    padding: 12px 8px;
    font-size: 14px;
    color: rgba(0, 0, 0, 0.65);
    border-bottom: 1px solid #f0f0f0;
    vertical-align: top;
  }

  .lp-btn {
    border-radius: 2px;
    padding: 4px 15px;
    font-size: 14px;
    height: 32px;
    line-height: 1.5;
    transition: all 0.3s ease;
  }

  .lp-btn-primary {
    background-color: #1890ff;
    border-color: #1890ff;
    color: #fff;
  }

  .lp-btn-primary:hover {
    background-color: #40a9ff;
    border-color: #40a9ff;
    color: #fff;
  }

  .lp-btn-outline {
    color: rgba(0, 0, 0, 0.65);
    border: 1px solid #d9d9d9;
    background: #fff;
  }

  .lp-btn-outline:hover {
    color: #40a9ff;
    border-color: #40a9ff;
  }

  .section-list .list-group-item {
    border-radius: 2px;
    border: 1px solid #f0f0f0;
    margin-bottom: 6px;
    cursor: pointer;
  }

  .section-list .list-group-item.active {
    background-color: #e6f7ff;
    border-color: #91d5ff;
    color: #0050b3;
    font-weight: 500;
  }

  .lp-muted {
    color: rgba(0, 0, 0, 0.55);
    font-size: 13px;
  }

  .icon-preview {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: 1px solid #f0f0f0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    overflow: hidden;
  }

  .icon-preview img {
    max-width: 100%;
    max-height: 100%;
    display: block;
  }

  .lp-section {
    display: none;
  }

  .lp-section.active {
    display: block;
  }

  .preview-frame {
    width: 100%;
    min-height: 520px;
    border: 1px solid #e5e5e5;
    border-radius: 6px;
    background: #fff;
  }
</style>

<div class="container-fluid py-3">
  <div class="lp-card">
    <div class="lp-card-header d-flex flex-wrap gap-3 align-items-center justify-content-between">
      <div>
        <h5 class="mb-1">Landing Page Preview</h5>
        <div class="lp-muted">Paste the landing page URL to see updates live.</div>
      </div>
      <div class="d-flex flex-wrap gap-2 align-items-center">
        <input type="text" class="form-control" id="previewUrl" style="min-width:260px" placeholder="https://your-landing-page">
        <button class="lp-btn lp-btn-primary" id="previewReload">Reload Preview</button>
        <a class="lp-btn lp-btn-outline" id="previewOpen" href="#" target="_blank">Open in new tab</a>
      </div>
    </div>
    <div class="lp-card-body">
      <iframe id="previewFrame" class="preview-frame" src=""></iframe>
    </div>
  </div>

  <div id="lpAlert"></div>

  <div class="row g-3">
    <div class="col-lg-3">
      <div class="lp-card">
        <div class="lp-card-header">
          <h6 class="mb-1">Landing Page Sections</h6>
          <div class="lp-muted">Select a section to configure.</div>
        </div>
        <div class="lp-card-body section-list">
          <div class="list-group">
            <div class="list-group-item active" data-section="navbar">Navbar</div>
            <div class="list-group-item" data-section="hero">Hero</div>
            <div class="list-group-item" data-section="features">Features</div>
            <div class="list-group-item" data-section="new-products">New Products</div>
            <div class="list-group-item" data-section="customer-favorites">Customer Favorites</div>
            <div class="list-group-item" data-section="team">Team</div>
            <div class="list-group-item" data-section="testimonials">Testimonials</div>
            <div class="list-group-item" data-section="footer">Footer</div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-9">
      <div class="lp-card">
        <div class="lp-card-body">
          <!-- Navbar Section -->
          <div class="lp-section active" data-section="navbar">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <h5 class="mb-1">Navbar</h5>
                <div class="lp-muted">Logo and navigation links.</div>
              </div>
              <button class="lp-btn lp-btn-primary" id="btnAddNavLink"><i class="bi bi-plus-lg me-1"></i>Add Link</button>
            </div>
            <div class="alert alert-info">
              <div><strong>Landing Page Impact</strong></div>
              <div class="small mt-1">Anchors: <code>#home</code>, <code>#advantage</code>, <code>#new-product</code>, etc</div>
              <div class="small mt-1">API: <code><?= base_url('api/landing-page/navbar') ?></code></div>
            </div>
            <div class="lp-card mb-3">
              <div class="lp-card-header"><strong>Logo</strong></div>
              <div class="lp-card-body">
                <form id="navbarLogoForm" class="row g-3">
                  <div class="col-md-8">
                    <label class="form-label">Logo Image</label>
                    <input type="hidden" class="form-control" name="logo_url" id="navbarLogoUrl" required>
                    <input type="file" class="form-control" id="navbarLogoFile" accept=".svg,.png,.jpg,.jpeg,.webp">
                    <div class="lp-muted mt-1" id="navbarLogoPreview">No image uploaded yet.</div>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Logo Alt</label>
                    <input type="text" class="form-control" name="logo_alt">
                  </div>
                  <div class="col-12">
                    <button class="lp-btn lp-btn-primary" type="submit">Save Logo</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="table-responsive">
              <table class="lp-table" id="navLinksTable">
                <thead>
                  <tr>
                    <th style="width:120px">Side</th>
                    <th>Label</th>
                    <th>Href</th>
                    <th style="width:120px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td colspan="4" class="text-center lp-muted">Loading...</td></tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Hero Section -->
          <div class="lp-section" data-section="hero">
            <div class="mb-3">
              <h5 class="mb-1">Hero</h5>
              <div class="lp-muted">Main banner content and CTAs.</div>
            </div>
            <div class="alert alert-info">
              <div><strong>Landing Page Impact</strong></div>
              <div class="small mt-1">Anchor: <code>#home</code></div>
              <div class="small mt-1">API: <code><?= base_url('api/landing-page/hero') ?></code></div>
            </div>
            <form id="heroForm" class="row g-3">
              <div class="col-md-8">
                <label class="form-label">Background Image</label>
                <input type="hidden" class="form-control" name="background_image_url" id="heroBackgroundUrl">
                <input type="file" class="form-control" id="heroBackgroundFile" accept=".svg,.png,.jpg,.jpeg,.webp">
                <div class="lp-muted mt-1" id="heroBackgroundPreview">No image uploaded yet.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Title Line 1</label>
                <input type="text" class="form-control" name="title_line_1" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Title Line 2</label>
                <input type="text" class="form-control" name="title_line_2">
              </div>
              <div class="col-12">
                <label class="form-label">Subtitle</label>
                <textarea class="form-control" name="subtitle" rows="2" required></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Primary CTA Label</label>
                <input type="text" class="form-control" name="primary_label">
              </div>
              <div class="col-md-6">
                <label class="form-label">Primary CTA Link</label>
                <input type="text" class="form-control" name="primary_href">
              </div>
              <div class="col-md-6">
                <label class="form-label">Secondary CTA Label</label>
                <input type="text" class="form-control" name="secondary_label">
              </div>
              <div class="col-md-6">
                <label class="form-label">Secondary CTA Link</label>
                <input type="text" class="form-control" name="secondary_href">
              </div>
              <div class="col-12">
                <button class="lp-btn lp-btn-primary" type="submit">Save Hero</button>
              </div>
            </form>
          </div>

          <!-- Features Section -->
          <div class="lp-section" data-section="features">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <h5 class="mb-1">Features Section</h5>
                <div class="lp-muted">Controls the Advantages section on the landing page.</div>
              </div>
              <button class="lp-btn lp-btn-primary" id="btnAddFeature"><i class="bi bi-plus-lg me-1"></i>Add Feature</button>
            </div>
            <div class="alert alert-info">
              <div><strong>Landing Page Impact</strong></div>
              <div class="small mt-1">Anchor: <code>#advantage</code></div>
              <div class="small mt-1">API: <code><?= base_url('api/landing-page/features') ?></code></div>
            </div>
            <div class="lp-card mb-3">
              <div class="lp-card-header"><strong>Section Header</strong></div>
              <div class="lp-card-body">
                <form id="featureHeaderForm" class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label">Eyebrow</label>
                    <input type="text" class="form-control" name="eyebrow">
                  </div>
                  <div class="col-md-8">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="2" required></textarea>
                  </div>
                  <div class="col-12">
                    <button class="lp-btn lp-btn-primary" type="submit">Save Header</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="table-responsive">
              <table class="lp-table" id="featureTable">
                <thead>
                  <tr>
                    <th style="width:64px">Icon</th>
                    <th>Title</th>
                    <th style="width:120px">Position</th>
                    <th style="width:120px">Has Image</th>
                    <th style="width:120px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td colspan="5" class="text-center lp-muted">Loading...</td></tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- New Products Section -->
          <div class="lp-section" data-section="new-products">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <h5 class="mb-1">New Products</h5>
                <div class="lp-muted">Carousel products and feature bullets.</div>
              </div>
              <button class="lp-btn lp-btn-primary" id="btnAddProduct"><i class="bi bi-plus-lg me-1"></i>Add Product</button>
            </div>
            <div class="alert alert-info">
              <div><strong>Landing Page Impact</strong></div>
              <div class="small mt-1">Anchor: <code>#new-product</code></div>
              <div class="small mt-1">API: <code><?= base_url('api/landing-page/new-products') ?></code></div>
            </div>
            <div class="lp-card mb-3">
              <div class="lp-card-header"><strong>Section Header</strong></div>
              <div class="lp-card-body">
                <form id="newProductsHeaderForm" class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label">Eyebrow</label>
                    <input type="text" class="form-control" name="eyebrow">
                  </div>
                  <div class="col-md-8">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="2" required></textarea>
                  </div>
                  <div class="col-12">
                    <button class="lp-btn lp-btn-primary" type="submit">Save Header</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="table-responsive">
              <table class="lp-table" id="productsTable">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th style="width:180px">Category</th>
                    <th style="width:120px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td colspan="3" class="text-center lp-muted">Loading...</td></tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Customer Favorites Section -->
          <div class="lp-section" data-section="customer-favorites">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <h5 class="mb-1">Customer Favorites</h5>
                <div class="lp-muted">Category showcase blocks.</div>
              </div>
              <button class="lp-btn lp-btn-primary" id="btnAddFavorite"><i class="bi bi-plus-lg me-1"></i>Add Item</button>
            </div>
            <div class="alert alert-info">
              <div><strong>Landing Page Impact</strong></div>
              <div class="small mt-1">Anchor: <code>#best-product</code></div>
              <div class="small mt-1">API: <code><?= base_url('api/landing-page/customer-favorites') ?></code></div>
            </div>
            <div class="lp-card mb-3">
              <div class="lp-card-header"><strong>Section Header</strong></div>
              <div class="lp-card-body">
                <form id="favoritesHeaderForm" class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label">Eyebrow</label>
                    <input type="text" class="form-control" name="eyebrow">
                  </div>
                  <div class="col-md-8">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="2" required></textarea>
                  </div>
                  <div class="col-12">
                    <button class="lp-btn lp-btn-primary" type="submit">Save Header</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="table-responsive">
              <table class="lp-table" id="favoritesTable">
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Product Showcase</th>
                    <th style="width:120px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td colspan="3" class="text-center lp-muted">Loading...</td></tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Team Section -->
          <div class="lp-section" data-section="team">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <h5 class="mb-1">Team</h5>
                <div class="lp-muted">Team member cards.</div>
              </div>
              <button class="lp-btn lp-btn-primary" id="btnAddTeam"><i class="bi bi-plus-lg me-1"></i>Add Member</button>
            </div>
            <div class="alert alert-info">
              <div><strong>Landing Page Impact</strong></div>
              <div class="small mt-1">Anchor: <code>#team</code></div>
              <div class="small mt-1">API: <code><?= base_url('api/landing-page/team') ?></code></div>
            </div>
            <div class="lp-card mb-3">
              <div class="lp-card-header"><strong>Section Header</strong></div>
              <div class="lp-card-body">
                <form id="teamHeaderForm" class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label">Eyebrow</label>
                    <input type="text" class="form-control" name="eyebrow">
                  </div>
                  <div class="col-md-8">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="2" required></textarea>
                  </div>
                  <div class="col-12">
                    <button class="lp-btn lp-btn-primary" type="submit">Save Header</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="table-responsive">
              <table class="lp-table" id="teamTable">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th style="width:120px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td colspan="3" class="text-center lp-muted">Loading...</td></tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Testimonials Section -->
          <div class="lp-section" data-section="testimonials">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <h5 class="mb-1">Testimonials</h5>
                <div class="lp-muted">Customer quotes and ratings.</div>
              </div>
              <button class="lp-btn lp-btn-primary" id="btnAddTestimonial"><i class="bi bi-plus-lg me-1"></i>Add Testimonial</button>
            </div>
            <div class="alert alert-info">
              <div><strong>Landing Page Impact</strong></div>
              <div class="small mt-1">Anchor: <code>#testimoni</code></div>
              <div class="small mt-1">API: <code><?= base_url('api/landing-page/testimonials') ?></code></div>
            </div>
            <div class="lp-card mb-3">
              <div class="lp-card-header"><strong>Section Header</strong></div>
              <div class="lp-card-body">
                <form id="testimonialsHeaderForm" class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label">Eyebrow</label>
                    <input type="text" class="form-control" name="eyebrow">
                  </div>
                  <div class="col-md-8">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="2" required></textarea>
                  </div>
                  <div class="col-12">
                    <button class="lp-btn lp-btn-primary" type="submit">Save Header</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="table-responsive">
              <table class="lp-table" id="testimonialsTable">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th style="width:90px">Rating</th>
                    <th style="width:120px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td colspan="4" class="text-center lp-muted">Loading...</td></tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Footer Section -->
          <div class="lp-section" data-section="footer">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <h5 class="mb-1">Footer</h5>
                <div class="lp-muted">Brand info, contact, and links.</div>
              </div>
              <div class="d-flex gap-2">
                <button class="lp-btn lp-btn-primary" id="btnAddFooterLink"><i class="bi bi-plus-lg me-1"></i>Add Info Link</button>
                <button class="lp-btn lp-btn-outline" id="btnAddSocialLink"><i class="bi bi-plus-lg me-1"></i>Add Social Link</button>
              </div>
            </div>
            <div class="alert alert-info">
              <div><strong>Landing Page Impact</strong></div>
              <div class="small mt-1">Footer area</div>
              <div class="small mt-1">API: <code><?= base_url('api/landing-page/footer') ?></code></div>
            </div>
            <div class="lp-card mb-3">
              <div class="lp-card-header"><strong>Footer Content</strong></div>
              <div class="lp-card-body">
                <form id="footerForm" class="row g-3">
                  <div class="col-md-8">
                    <label class="form-label">Logo Image</label>
                    <input type="hidden" class="form-control" name="logo_url" id="footerLogoUrl">
                    <input type="file" class="form-control" id="footerLogoFile" accept=".svg,.png,.jpg,.jpeg,.webp">
                    <div class="lp-muted mt-1" id="footerLogoPreview">No image uploaded yet.</div>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Logo Alt</label>
                    <input type="text" class="form-control" name="logo_alt">
                  </div>
                  <div class="col-12">
                    <label class="form-label">Taglines (one per line)</label>
                    <textarea class="form-control" name="taglines" rows="2"></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Newsletter Placeholder</label>
                    <input type="text" class="form-control" name="newsletter_placeholder">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Newsletter CTA Label</label>
                    <input type="text" class="form-control" name="newsletter_cta">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Contact Phone</label>
                    <input type="text" class="form-control" name="contact_phone">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Contact Email</label>
                    <input type="email" class="form-control" name="contact_email">
                  </div>
                  <div class="col-12">
                    <label class="form-label">Addresses (one per line)</label>
                    <textarea class="form-control" name="contact_addresses" rows="2"></textarea>
                  </div>
                  <div class="col-12">
                    <button class="lp-btn lp-btn-primary" type="submit">Save Footer</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <div class="lp-card">
                  <div class="lp-card-header"><strong>Info Links</strong></div>
                  <div class="lp-card-body">
                    <div class="table-responsive">
                      <table class="lp-table" id="footerLinksTable">
                        <thead>
                          <tr>
                            <th>Label</th>
                            <th>Href</th>
                            <th style="width:90px">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr><td colspan="3" class="text-center lp-muted">Loading...</td></tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="lp-card">
                  <div class="lp-card-header"><strong>Social Links</strong></div>
                  <div class="lp-card-body">
                    <div class="table-responsive">
                      <table class="lp-table" id="footerSocialTable">
                        <thead>
                          <tr>
                            <th>Platform</th>
                            <th>Href</th>
                            <th style="width:90px">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr><td colspan="3" class="text-center lp-muted">Loading...</td></tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Navbar Link Modal -->
<div class="modal fade" id="navLinkModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Navbar Link</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="navLinkForm" class="row g-3">
          <input type="hidden" name="id" id="navLinkId">
          <div class="col-12">
            <label class="form-label">Side</label>
            <select class="form-select" name="side" id="navLinkSide">
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label">Label</label>
            <input type="text" class="form-control" name="label" id="navLinkLabel" required>
          </div>
          <div class="col-12">
            <label class="form-label">Href</label>
            <input type="text" class="form-control" name="href" id="navLinkHref" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="lp-btn lp-btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="lp-btn lp-btn-primary" id="navLinkSaveBtn">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Feature Modal -->
<div class="modal fade" id="featureModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="featureModalTitle">Add Feature</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="featureForm">
          <input type="hidden" name="id" id="featureId">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" name="title" id="featureTitle" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Position</label>
              <select class="form-select" name="position" id="featurePosition">
                <option value="">Select</option>
                <option value="top-left">Top Left</option>
                <option value="top-right">Top Right</option>
                <option value="bottom-left">Bottom Left</option>
                <option value="bottom-right">Bottom Right</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" name="description" id="featureDescription" rows="3" required></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">Icon Upload (SVG/PNG/JPG/WEBP)</label>
              <input type="file" class="form-control" id="featureIconFile" accept=".svg,.png,.jpg,.jpeg,.webp">
              <div class="lp-muted mt-1">Max 5MB. Upload to generate icon URL.</div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Icon URL</label>
              <input type="text" class="form-control" name="icon_url" id="featureIconUrl" readonly>
              <div class="lp-muted mt-1" id="iconLegacyNote" style="display:none;">Inline SVG stored. Upload to replace.</div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Icon Alt</label>
              <input type="text" class="form-control" name="icon_alt" id="featureIconAlt">
            </div>
            <div class="col-md-6">
              <label class="form-label">Icon Type</label>
              <input type="text" class="form-control" name="icon_type" id="featureIconType" readonly>
            </div>
            <div class="col-md-6">
              <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" value="1" id="featureHasImage">
                <label class="form-check-label" for="featureHasImage">Has Image Card</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="lp-btn lp-btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="lp-btn lp-btn-primary" id="featureSaveBtn">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalTitle">Add Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="productForm" class="row g-3">
          <input type="hidden" id="productId">
          <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" id="productName" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Category</label>
            <input type="text" class="form-control" id="productCategory">
          </div>
          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea class="form-control" id="productDescription" rows="3" required></textarea>
          </div>
          <div class="col-12">
            <label class="form-label">Product Image</label>
            <input type="hidden" class="form-control" id="productImage">
            <input type="file" class="form-control" id="productImageFile" accept=".svg,.png,.jpg,.jpeg,.webp">
            <div class="lp-muted mt-1" id="productImagePreview">No image uploaded yet.</div>
          </div>
          <div class="col-12">
            <label class="form-label">Feature Lines (one per line: label|icon_text|icon_url)</label>
            <textarea class="form-control" id="productFeatures" rows="4" placeholder="Exfoliating Formula|??|https://..."></textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label">Upload Feature Icon</label>
            <input type="file" class="form-control" id="productIconUpload" accept=".svg,.png,.jpg,.jpeg,.webp">
          </div>
          <div class="col-md-6">
            <label class="form-label">Uploaded Icon URL</label>
            <input type="text" class="form-control" id="productIconUrl" readonly>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="lp-btn lp-btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="lp-btn lp-btn-primary" id="productSaveBtn">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Favorites Modal -->
<div class="modal fade" id="favoriteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="favoriteModalTitle">Add Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="favoriteForm" class="row g-3">
          <input type="hidden" id="favoriteId">
          <div class="col-md-6">
            <label class="form-label">Category Heading</label>
            <input type="text" class="form-control" id="favoriteHeading" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" id="favoriteProductName" required>
          </div>
          <div class="col-12">
            <label class="form-label">Category Description (one per line)</label>
            <textarea class="form-control" id="favoriteDescription" rows="3"></textarea>
          </div>
          <div class="col-12">
            <label class="form-label">Product Description</label>
            <textarea class="form-control" id="favoriteProductDescription" rows="2"></textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label">Product Image</label>
            <input type="hidden" class="form-control" id="favoriteProductImage">
            <input type="file" class="form-control" id="favoriteProductImageFile" accept=".svg,.png,.jpg,.jpeg,.webp">
            <div class="lp-muted mt-1" id="favoriteProductImagePreview">No image uploaded yet.</div>
          </div>
          <div class="col-md-6">
            <label class="form-label">Mini Image</label>
            <input type="hidden" class="form-control" id="favoriteMiniImage">
            <input type="file" class="form-control" id="favoriteMiniImageFile" accept=".svg,.png,.jpg,.jpeg,.webp">
            <div class="lp-muted mt-1" id="favoriteMiniImagePreview">No image uploaded yet.</div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="lp-btn lp-btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="lp-btn lp-btn-primary" id="favoriteSaveBtn">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Team Modal -->
<div class="modal fade" id="teamModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="teamModalTitle">Add Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="teamForm" class="row g-3">
          <input type="hidden" id="teamId">
          <div class="col-12">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" id="teamName" required>
          </div>
          <div class="col-12">
            <label class="form-label">Role</label>
            <input type="text" class="form-control" id="teamRole" required>
          </div>
          <div class="col-12">
            <label class="form-label">Member Image</label>
            <input type="hidden" class="form-control" id="teamImage">
            <input type="file" class="form-control" id="teamImageFile" accept=".svg,.png,.jpg,.jpeg,.webp">
            <div class="lp-muted mt-1" id="teamImagePreview">No image uploaded yet.</div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="lp-btn lp-btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="lp-btn lp-btn-primary" id="teamSaveBtn">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- Testimonials Modal -->
<div class="modal fade" id="testimonialModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="testimonialModalTitle">Add Testimonial</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="testimonialForm" class="row g-3">
          <input type="hidden" id="testimonialId">
          <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" id="testimonialName" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Role</label>
            <input type="text" class="form-control" id="testimonialRole">
          </div>
          <div class="col-md-6">
            <label class="form-label">Before Image</label>
            <input type="hidden" class="form-control" id="testimonialBefore">
            <input type="file" class="form-control" id="testimonialBeforeFile" accept=".svg,.png,.jpg,.jpeg,.webp">
            <div class="lp-muted mt-1" id="testimonialBeforePreview">No image uploaded yet.</div>
          </div>
          <div class="col-md-6">
            <label class="form-label">After Image</label>
            <input type="hidden" class="form-control" id="testimonialAfter">
            <input type="file" class="form-control" id="testimonialAfterFile" accept=".svg,.png,.jpg,.jpeg,.webp">
            <div class="lp-muted mt-1" id="testimonialAfterPreview">No image uploaded yet.</div>
          </div>
          <div class="col-12">
            <label class="form-label">Content</label>
            <textarea class="form-control" id="testimonialContent" rows="4" required></textarea>
          </div>
          <div class="col-md-4">
            <label class="form-label">Rating (1-5)</label>
            <input type="number" min="1" max="5" class="form-control" id="testimonialRating" value="5">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="lp-btn lp-btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="lp-btn lp-btn-primary" id="testimonialSaveBtn">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Footer Info Link Modal -->
<div class="modal fade" id="footerLinkModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="footerLinkModalTitle">Info Link</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="footerLinkForm" class="row g-3">
          <input type="hidden" id="footerLinkId">
          <div class="col-12">
            <label class="form-label">Label</label>
            <input type="text" class="form-control" id="footerLinkLabel" required>
          </div>
          <div class="col-12">
            <label class="form-label">Href</label>
            <input type="text" class="form-control" id="footerLinkHref" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="lp-btn lp-btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="lp-btn lp-btn-primary" id="footerLinkSaveBtn">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Footer Social Link Modal -->
<div class="modal fade" id="socialLinkModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="socialLinkModalTitle">Social Link</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="socialLinkForm" class="row g-3">
          <input type="hidden" id="socialLinkId">
          <div class="col-12">
            <label class="form-label">Platform</label>
            <input type="text" class="form-control" id="socialPlatform" required>
          </div>
          <div class="col-12">
            <label class="form-label">Href</label>
            <input type="text" class="form-control" id="socialHref" required>
          </div>
          <div class="col-12">
            <label class="form-label">Icon Key</label>
            <input type="text" class="form-control" id="socialIcon" placeholder="instagram">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="lp-btn lp-btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="lp-btn lp-btn-primary" id="socialSaveBtn">Save</button>
      </div>
    </div>
  </div>
</div>

<script>
  const landingBaseUrl = 'https://app.montera-group.com/';
  const landingBaseApi = 'https://app.montera-group.com/api/';

  const navLinkModal = new bootstrap.Modal(document.getElementById('navLinkModal'));
  const featureModal = new bootstrap.Modal(document.getElementById('featureModal'));
  const productModal = new bootstrap.Modal(document.getElementById('productModal'));
  const favoriteModal = new bootstrap.Modal(document.getElementById('favoriteModal'));
  const teamModal = new bootstrap.Modal(document.getElementById('teamModal'));
  const testimonialModal = new bootstrap.Modal(document.getElementById('testimonialModal'));
  const footerLinkModal = new bootstrap.Modal(document.getElementById('footerLinkModal'));
  const socialLinkModal = new bootstrap.Modal(document.getElementById('socialLinkModal'));

  let currentFeatures = [];
  let currentNav = { links_left: [], links_right: [] };
  let currentProducts = [];
  let currentFavorites = [];
  let currentTeam = [];
  let currentTestimonials = [];
  let currentFooter = { info_links: [], social_links: [] };

  function showAlert(type, message) {
    const html = `
      <div class="alert alert-${type} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;
    $('#lpAlert').html(html);
  }

  const imageValidationRules = {
    navbarLogo: { maxSizeMB: 1, ratio: 4 / 1, tolerance: 0.25, minWidth: 200, minHeight: 50 },
    heroBackground: { maxSizeMB: 5, ratio: 16 / 9, tolerance: 0.2, minWidth: 1200, minHeight: 600 },
    productImage: { maxSizeMB: 5, ratio: 1, tolerance: 0.1, minWidth: 600, minHeight: 600 },
    favoriteProductImage: { maxSizeMB: 5, ratio: 1, tolerance: 0.1, minWidth: 600, minHeight: 600 },
    favoriteMiniImage: { maxSizeMB: 3, ratio: 1, tolerance: 0.1, minWidth: 300, minHeight: 300 },
    teamImage: { maxSizeMB: 3, ratio: 1, tolerance: 0.1, minWidth: 400, minHeight: 400 },
    testimonialBefore: { maxSizeMB: 5, ratio: 1, tolerance: 0.1, minWidth: 500, minHeight: 500 },
    testimonialAfter: { maxSizeMB: 5, ratio: 1, tolerance: 0.1, minWidth: 500, minHeight: 500 },
    footerLogo: { maxSizeMB: 1, ratio: 4 / 1, tolerance: 0.25, minWidth: 200, minHeight: 50 }
  };

  function toAbsoluteUrl(value) {
    if (!value) return '';
    if (value.startsWith('http://') || value.startsWith('https://')) return value;
    if (value.startsWith('/')) return `${landingBaseUrl}${value.substring(1)}`;
    return `${landingBaseUrl}${value}`;
  }

  function normalizeUploadUrl(payload) {
    if (!payload) return '';
    if (payload.url) return payload.url;
    if (payload.path) return toAbsoluteUrl(payload.path);
    return '';
  }

  function setImageField(inputSelector, value, previewSelector) {
    const url = toAbsoluteUrl(value);
    $(inputSelector).val(url);
    if (previewSelector) {
      $(previewSelector).text(url ? `Current: ${url}` : 'No image uploaded yet.');
    }
  }

  function validateImageFile(file, rules) {
    return new Promise((resolve, reject) => {
      if (!file) {
        reject('Image file is required.');
        return;
      }
      if (!file.type || !file.type.startsWith('image/')) {
        reject('File must be an image.');
        return;
      }
      if (rules && rules.maxSizeMB) {
        const maxBytes = rules.maxSizeMB * 1024 * 1024;
        if (file.size > maxBytes) {
          reject(`Image must be <= ${rules.maxSizeMB}MB.`);
          return;
        }
      }
      if (file.type === 'image/svg+xml') {
        resolve({ width: 0, height: 0 });
        return;
      }
      const img = new Image();
      const url = URL.createObjectURL(file);
      img.onload = function() {
        const width = img.width;
        const height = img.height;
        URL.revokeObjectURL(url);

        if (rules && rules.minWidth && width < rules.minWidth) {
          reject(`Image width must be at least ${rules.minWidth}px.`);
          return;
        }
        if (rules && rules.minHeight && height < rules.minHeight) {
          reject(`Image height must be at least ${rules.minHeight}px.`);
          return;
        }
        if (rules && rules.ratio) {
          const ratio = width / height;
          const tolerance = rules.tolerance || 0;
          const minRatio = rules.ratio * (1 - tolerance);
          const maxRatio = rules.ratio * (1 + tolerance);
          if (ratio < minRatio || ratio > maxRatio) {
            reject(`Image must be proportional to ${(rules.ratio).toFixed(2)}:1.`);
            return;
          }
        }
        resolve({ width, height });
      };
      img.onerror = function() {
        URL.revokeObjectURL(url);
        reject('Invalid image file.');
      };
      img.src = url;
    });
  }

  function uploadLandingImage(file, rules, onSuccess) {
    if (!file) return;
    validateImageFile(file, rules).then(function() {
      const formData = new FormData();
      formData.append('image', file);
      $.ajax({
        url: `${landingBaseApi}landing-page/image-upload`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          const url = normalizeUploadUrl(response);
          if (url) {
            onSuccess(url);
            return;
          }
          if (response.error) {
            showAlert('danger', response.error);
          } else {
            showAlert('danger', 'Upload failed.');
          }
        },
        error: function(xhr) {
          const msg = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'Upload failed.';
          showAlert('danger', msg);
        }
      });
    }).catch(function(message) {
      showAlert('danger', message);
    });
  }

  function setPreviewUrl(url) {
    if (!url) return;
    $('#previewUrl').val(url);
    $('#previewFrame').attr('src', '');
    $('#previewOpen').attr('href', url);
    localStorage.setItem('landing_preview_url', url);
    window.open(url, '_blank', 'noopener');
  }

  function initPreview() {
    const saved = localStorage.getItem('landing_preview_url');
    if (saved) {
      setPreviewUrl(saved);
    }
  }

  function parseFeatureLines(text) {
    const lines = text.split(/\r\n|\r|\n/).map(line => line.trim()).filter(Boolean);
    return lines.map(line => {
      const parts = line.split('|');
      return {
        label: (parts[0] || '').trim(),
        icon: (parts[1] || '').trim(),
        icon_url: (parts[2] || '').trim()
      };
    }).filter(item => item.label);
  }

  function formatFeatureLines(features) {
    if (!Array.isArray(features)) return '';
    return features.map(item => {
      const label = item.label || '';
      const icon = item.icon || '';
      const iconUrl = item.icon_url || '';
      return [label, icon, iconUrl].join('|').replace(/\|+$/g, '');
    }).join('\n');
  }

  function switchSection(sectionKey) {
    $('.section-list .list-group-item').removeClass('active');
    $(`.section-list .list-group-item[data-section="${sectionKey}"]`).addClass('active');
    $('.lp-section').removeClass('active');
    $(`.lp-section[data-section="${sectionKey}"]`).addClass('active');
  }

  function loadNavbar() {
    $.get(`${landingBaseUrl}landing-page/navbar-data`, function(response) {
      if (!response.success) return;
      currentNav = response.data || { links_left: [], links_right: [] };
      setImageField('#navbarLogoUrl', currentNav.logo ? currentNav.logo.url : '', '#navbarLogoPreview');
      $('#navbarLogoForm [name="logo_alt"]').val(currentNav.logo ? currentNav.logo.alt : '');
      renderNavLinks();
    }, 'json');
  }

  function renderNavLinks() {
    const rows = [];
    const left = currentNav.links_left || [];
    const right = currentNav.links_right || [];
    left.forEach(item => rows.push({ side: 'left', ...item }));
    right.forEach(item => rows.push({ side: 'right', ...item }));

    if (!rows.length) {
      $('#navLinksTable tbody').html('<tr><td colspan="4" class="text-center lp-muted">No links yet.</td></tr>');
      return;
    }

    const html = rows.map(item => `
      <tr>
        <td>${item.side}</td>
        <td>${item.label || '-'}</td>
        <td>${item.href || '-'}</td>
        <td>
          <button class="lp-btn lp-btn-outline btn-sm me-1" onclick="editNavLink('${item.id}','${item.side}')">Edit</button>
          <button class="lp-btn lp-btn-outline btn-sm text-danger" onclick="deleteNavLink('${item.id}','${item.side}')">Delete</button>
        </td>
      </tr>
    `).join('');

    $('#navLinksTable tbody').html(html);
  }

  function editNavLink(id, side) {
    const list = side === 'left' ? currentNav.links_left : currentNav.links_right;
    const item = (list || []).find(link => link.id === id);
    if (!item) return;
    $('#navLinkId').val(item.id);
    $('#navLinkSide').val(side);
    $('#navLinkLabel').val(item.label || '');
    $('#navLinkHref').val(item.href || '');
    navLinkModal.show();
  }

  function deleteNavLink(id, side) {
    if (!confirm('Delete this link?')) return;
    $.post(`${landingBaseUrl}landing-page/navbar-link-delete`, { id, side }, function(response) {
      if (response.success) {
        loadNavbar();
      } else {
        showAlert('danger', response.message || 'Delete failed.');
      }
    }, 'json');
  }

  function loadHero() {
    $.get(`${landingBaseUrl}landing-page/hero-data`, function(response) {
      if (!response.success) return;
      const data = response.data || {};
      setImageField('#heroBackgroundUrl', data.background_image_url || '', '#heroBackgroundPreview');
      $('#heroForm [name="title_line_1"]').val(data.title ? data.title.line_1 : '');
      $('#heroForm [name="title_line_2"]').val(data.title ? data.title.line_2 : '');
      $('#heroForm [name="subtitle"]').val(data.subtitle || '');
      $('#heroForm [name="primary_label"]').val(data.primary_cta ? data.primary_cta.label : '');
      $('#heroForm [name="primary_href"]').val(data.primary_cta ? data.primary_cta.href : '');
      $('#heroForm [name="secondary_label"]').val(data.secondary_cta ? data.secondary_cta.label : '');
      $('#heroForm [name="secondary_href"]').val(data.secondary_cta ? data.secondary_cta.href : '');
    }, 'json');
  }

  function loadFeatures() {
    $.get(`${landingBaseUrl}landing-page/features-data`, function(response) {
      if (!response.success) return;
      const data = response.data || {};
      currentFeatures = data.items || [];
      $('#featureHeaderForm [name="eyebrow"]').val(data.eyebrow || '');
      $('#featureHeaderForm [name="title"]').val(data.title || '');
      $('#featureHeaderForm [name="description"]').val(data.description || '');
      renderFeatureTable();
    }, 'json');
  }

  function renderFeatureTable() {
    if (!currentFeatures.length) {
      $('#featureTable tbody').html('<tr><td colspan="5" class="text-center lp-muted">No features yet.</td></tr>');
      return;
    }

    const html = currentFeatures.map(item => {
      let iconCell = '<span class="lp-muted">No icon</span>';
      if (item.icon_url) {
        iconCell = `<div class="icon-preview"><img src="${item.icon_url}" alt="${item.icon_alt || 'icon'}"></div>`;
      } else if (item.icon_svg) {
        iconCell = '<span class="lp-muted">Inline SVG</span>';
      }
      return `
        <tr>
          <td>${iconCell}</td>
          <td>
            <div class="fw-semibold">${item.title || '-'}</div>
            <div class="lp-muted">${item.description || ''}</div>
          </td>
          <td>${item.position || '-'}</td>
          <td>${item.has_image ? 'Yes' : 'No'}</td>
          <td>
            <button class="lp-btn lp-btn-outline btn-sm me-1" onclick="editFeature('${item.id}')">Edit</button>
            <button class="lp-btn lp-btn-outline btn-sm text-danger" onclick="deleteFeature('${item.id}')">Delete</button>
          </td>
        </tr>
      `;
    }).join('');

    $('#featureTable tbody').html(html);
  }

  function resetFeatureForm() {
    $('#featureForm')[0].reset();
    $('#featureId').val('');
    $('#featureIconUrl').val('');
    $('#featureIconType').val('');
    $('#featureHasImage').prop('checked', false);
    $('#iconLegacyNote').hide();
  }

  function editFeature(id) {
    const item = currentFeatures.find(f => f.id === id);
    if (!item) return;
    resetFeatureForm();
    $('#featureModalTitle').text('Edit Feature');
    $('#featureId').val(item.id);
    $('#featureTitle').val(item.title || '');
    $('#featureDescription').val(item.description || '');
    $('#featurePosition').val(item.position || '');
    $('#featureIconUrl').val(item.icon_url || '');
    $('#featureIconType').val(item.icon_type || '');
    $('#featureIconAlt').val(item.icon_alt || '');
    $('#featureHasImage').prop('checked', item.has_image ? true : false);
    if (!item.icon_url && item.icon_svg) {
      $('#iconLegacyNote').show();
    } else {
      $('#iconLegacyNote').hide();
    }
    featureModal.show();
  }

  function deleteFeature(id) {
    if (!confirm('Delete this feature?')) return;
    $.post(`${landingBaseUrl}landing-page/features-delete`, { id }, function(response) {
      if (response.success) {
        loadFeatures();
      } else {
        showAlert('danger', response.message || 'Delete failed.');
      }
    }, 'json');
  }
  function loadNewProducts() {
    $.get(`${landingBaseUrl}landing-page/new-products-data`, function(response) {
      if (!response.success) return;
      const data = response.data || {};
      currentProducts = data.products || [];
      $('#newProductsHeaderForm [name="eyebrow"]').val(data.eyebrow || '');
      $('#newProductsHeaderForm [name="title"]').val(data.title || '');
      $('#newProductsHeaderForm [name="description"]').val(data.description || '');
      renderProductsTable();
    }, 'json');
  }

  function renderProductsTable() {
    if (!currentProducts.length) {
      $('#productsTable tbody').html('<tr><td colspan="3" class="text-center lp-muted">No products yet.</td></tr>');
      return;
    }

    const html = currentProducts.map(item => `
      <tr>
        <td>
          <div class="fw-semibold">${item.name || '-'}</div>
          <div class="lp-muted">${item.description || ''}</div>
        </td>
        <td>${item.category || '-'}</td>
        <td>
          <button class="lp-btn lp-btn-outline btn-sm me-1" onclick="editProduct('${item.id}')">Edit</button>
          <button class="lp-btn lp-btn-outline btn-sm text-danger" onclick="deleteProduct('${item.id}')">Delete</button>
        </td>
      </tr>
    `).join('');

    $('#productsTable tbody').html(html);
  }

  function resetProductForm() {
    $('#productForm')[0].reset();
    $('#productId').val('');
    $('#productIconUrl').val('');
    $('#productImagePreview').text('No image uploaded yet.');
  }

  function editProduct(id) {
    const item = currentProducts.find(p => p.id === id);
    if (!item) return;
    resetProductForm();
    $('#productModalTitle').text('Edit Product');
    $('#productId').val(item.id);
    $('#productName').val(item.name || '');
    $('#productCategory').val(item.category || '');
    $('#productDescription').val(item.description || '');
    setImageField('#productImage', item.image || '', '#productImagePreview');
    $('#productFeatures').val(formatFeatureLines(item.features || []));
    productModal.show();
  }

  function deleteProduct(id) {
    if (!confirm('Delete this product?')) return;
    $.post(`${landingBaseUrl}landing-page/new-products-delete`, { id }, function(response) {
      if (response.success) {
        loadNewProducts();
      } else {
        showAlert('danger', response.message || 'Delete failed.');
      }
    }, 'json');
  }

  function loadFavorites() {
    $.get(`${landingBaseUrl}landing-page/customer-favorites-data`, function(response) {
      if (!response.success) return;
      const data = response.data || {};
      currentFavorites = data.items || [];
      $('#favoritesHeaderForm [name="eyebrow"]').val(data.eyebrow || '');
      $('#favoritesHeaderForm [name="title"]').val(data.title || '');
      $('#favoritesHeaderForm [name="description"]').val(data.description || '');
      renderFavoritesTable();
    }, 'json');
  }

  function renderFavoritesTable() {
    if (!currentFavorites.length) {
      $('#favoritesTable tbody').html('<tr><td colspan="3" class="text-center lp-muted">No items yet.</td></tr>');
      return;
    }

    const html = currentFavorites.map(item => `
      <tr>
        <td>
          <div class="fw-semibold">${item.category_heading || '-'}</div>
          <div class="lp-muted">${(item.category_description || []).join(' ')}</div>
        </td>
        <td>
          <div class="fw-semibold">${item.product_showcase ? item.product_showcase.name : '-'}</div>
          <div class="lp-muted">${item.product_showcase ? item.product_showcase.description : ''}</div>
        </td>
        <td>
          <button class="lp-btn lp-btn-outline btn-sm me-1" onclick="editFavorite('${item.id}')">Edit</button>
          <button class="lp-btn lp-btn-outline btn-sm text-danger" onclick="deleteFavorite('${item.id}')">Delete</button>
        </td>
      </tr>
    `).join('');

    $('#favoritesTable tbody').html(html);
  }

  function resetFavoriteForm() {
    $('#favoriteForm')[0].reset();
    $('#favoriteId').val('');
    $('#favoriteProductImagePreview').text('No image uploaded yet.');
    $('#favoriteMiniImagePreview').text('No image uploaded yet.');
  }

  function editFavorite(id) {
    const item = currentFavorites.find(f => f.id === id);
    if (!item) return;
    resetFavoriteForm();
    $('#favoriteModalTitle').text('Edit Item');
    $('#favoriteId').val(item.id);
    $('#favoriteHeading').val(item.category_heading || '');
    $('#favoriteDescription').val((item.category_description || []).join('\n'));
    $('#favoriteProductName').val(item.product_showcase ? item.product_showcase.name : '');
    $('#favoriteProductDescription').val(item.product_showcase ? item.product_showcase.description : '');
    setImageField('#favoriteProductImage', item.product_showcase ? item.product_showcase.image : '', '#favoriteProductImagePreview');
    setImageField('#favoriteMiniImage', item.product_showcase ? item.product_showcase.mini_image : '', '#favoriteMiniImagePreview');
    favoriteModal.show();
  }

  function deleteFavorite(id) {
    if (!confirm('Delete this item?')) return;
    $.post(`${landingBaseUrl}landing-page/customer-favorites-delete`, { id }, function(response) {
      if (response.success) {
        loadFavorites();
      } else {
        showAlert('danger', response.message || 'Delete failed.');
      }
    }, 'json');
  }

  function loadTeam() {
    $.get(`${landingBaseUrl}landing-page/team-data`, function(response) {
      if (!response.success) return;
      const data = response.data || {};
      currentTeam = data.members || [];
      $('#teamHeaderForm [name="eyebrow"]').val(data.eyebrow || '');
      $('#teamHeaderForm [name="title"]').val(data.title || '');
      $('#teamHeaderForm [name="description"]').val(data.description || '');
      renderTeamTable();
    }, 'json');
  }

  function renderTeamTable() {
    if (!currentTeam.length) {
      $('#teamTable tbody').html('<tr><td colspan="3" class="text-center lp-muted">No members yet.</td></tr>');
      return;
    }

    const html = currentTeam.map(item => `
      <tr>
        <td>${item.name || '-'}</td>
        <td>${item.role || '-'}</td>
        <td>
          <button class="lp-btn lp-btn-outline btn-sm me-1" onclick="editTeam('${item.id}')">Edit</button>
          <button class="lp-btn lp-btn-outline btn-sm text-danger" onclick="deleteTeam('${item.id}')">Delete</button>
        </td>
      </tr>
    `).join('');

    $('#teamTable tbody').html(html);
  }

  function resetTeamForm() {
    $('#teamForm')[0].reset();
    $('#teamId').val('');
    $('#teamImagePreview').text('No image uploaded yet.');
  }

  function editTeam(id) {
    const item = currentTeam.find(m => m.id === id);
    if (!item) return;
    resetTeamForm();
    $('#teamModalTitle').text('Edit Member');
    $('#teamId').val(item.id);
    $('#teamName').val(item.name || '');
    $('#teamRole').val(item.role || '');
    setImageField('#teamImage', item.image || '', '#teamImagePreview');
    teamModal.show();
  }

  function deleteTeam(id) {
    if (!confirm('Delete this member?')) return;
    $.post(`${landingBaseUrl}landing-page/team-delete`, { id }, function(response) {
      if (response.success) {
        loadTeam();
      } else {
        showAlert('danger', response.message || 'Delete failed.');
      }
    }, 'json');
  }

  function loadTestimonials() {
    $.get(`${landingBaseUrl}landing-page/testimonials-data`, function(response) {
      if (!response.success) return;
      const data = response.data || {};
      currentTestimonials = data.items || [];
      $('#testimonialsHeaderForm [name="eyebrow"]').val(data.eyebrow || '');
      $('#testimonialsHeaderForm [name="title"]').val(data.title || '');
      $('#testimonialsHeaderForm [name="description"]').val(data.description || '');
      renderTestimonialsTable();
    }, 'json');
  }

  function renderTestimonialsTable() {
    if (!currentTestimonials.length) {
      $('#testimonialsTable tbody').html('<tr><td colspan="4" class="text-center lp-muted">No testimonials yet.</td></tr>');
      return;
    }

    const html = currentTestimonials.map(item => `
      <tr>
        <td>${item.name || '-'}</td>
        <td>${item.role || '-'}</td>
        <td>${item.rating || '-'}</td>
        <td>
          <button class="lp-btn lp-btn-outline btn-sm me-1" onclick="editTestimonial('${item.id}')">Edit</button>
          <button class="lp-btn lp-btn-outline btn-sm text-danger" onclick="deleteTestimonial('${item.id}')">Delete</button>
        </td>
      </tr>
    `).join('');

    $('#testimonialsTable tbody').html(html);
  }

  function resetTestimonialForm() {
    $('#testimonialForm')[0].reset();
    $('#testimonialId').val('');
    $('#testimonialRating').val(5);
    $('#testimonialBeforePreview').text('No image uploaded yet.');
    $('#testimonialAfterPreview').text('No image uploaded yet.');
  }

  function editTestimonial(id) {
    const item = currentTestimonials.find(t => t.id === id);
    if (!item) return;
    resetTestimonialForm();
    $('#testimonialModalTitle').text('Edit Testimonial');
    $('#testimonialId').val(item.id);
    $('#testimonialName').val(item.name || '');
    $('#testimonialRole').val(item.role || '');
    setImageField('#testimonialBefore', item.before_image || '', '#testimonialBeforePreview');
    setImageField('#testimonialAfter', item.after_image || '', '#testimonialAfterPreview');
    $('#testimonialContent').val(item.content || '');
    $('#testimonialRating').val(item.rating || 5);
    testimonialModal.show();
  }

  function deleteTestimonial(id) {
    if (!confirm('Delete this testimonial?')) return;
    $.post(`${landingBaseUrl}landing-page/testimonials-delete`, { id }, function(response) {
      if (response.success) {
        loadTestimonials();
      } else {
        showAlert('danger', response.message || 'Delete failed.');
      }
    }, 'json');
  }

  function loadFooter() {
    $.get(`${landingBaseUrl}landing-page/footer-data`, function(response) {
      if (!response.success) return;
      const data = response.data || {};
      currentFooter = data;
      setImageField('#footerLogoUrl', data.logo ? data.logo.url : '', '#footerLogoPreview');
      $('#footerForm [name="logo_alt"]').val(data.logo ? data.logo.alt : '');
      $('#footerForm [name="taglines"]').val((data.taglines || []).join('\n'));
      $('#footerForm [name="newsletter_placeholder"]').val(data.newsletter ? data.newsletter.placeholder : '');
      $('#footerForm [name="newsletter_cta"]').val(data.newsletter ? data.newsletter.cta_label : '');
      $('#footerForm [name="contact_phone"]').val(data.contact ? data.contact.phone : '');
      $('#footerForm [name="contact_email"]').val(data.contact ? data.contact.email : '');
      $('#footerForm [name="contact_addresses"]').val((data.contact && data.contact.addresses) ? data.contact.addresses.join('\n') : '');
      renderFooterLinks();
      renderFooterSocial();
    }, 'json');
  }

  function renderFooterLinks() {
    const links = currentFooter.info_links || [];
    if (!links.length) {
      $('#footerLinksTable tbody').html('<tr><td colspan="3" class="text-center lp-muted">No links yet.</td></tr>');
      return;
    }
    const html = links.map(item => `
      <tr>
        <td>${item.label || '-'}</td>
        <td>${item.href || '-'}</td>
        <td>
          <button class="lp-btn lp-btn-outline btn-sm me-1" onclick="editFooterLink('${item.id}')">Edit</button>
          <button class="lp-btn lp-btn-outline btn-sm text-danger" onclick="deleteFooterLink('${item.id}')">Delete</button>
        </td>
      </tr>
    `).join('');
    $('#footerLinksTable tbody').html(html);
  }

  function renderFooterSocial() {
    const links = currentFooter.social_links || [];
    if (!links.length) {
      $('#footerSocialTable tbody').html('<tr><td colspan="3" class="text-center lp-muted">No links yet.</td></tr>');
      return;
    }
    const html = links.map(item => `
      <tr>
        <td>${item.platform || '-'}</td>
        <td>${item.href || '-'}</td>
        <td>
          <button class="lp-btn lp-btn-outline btn-sm me-1" onclick="editSocialLink('${item.id}')">Edit</button>
          <button class="lp-btn lp-btn-outline btn-sm text-danger" onclick="deleteSocialLink('${item.id}')">Delete</button>
        </td>
      </tr>
    `).join('');
    $('#footerSocialTable tbody').html(html);
  }

  function resetFooterLinkForm() {
    $('#footerLinkForm')[0].reset();
    $('#footerLinkId').val('');
  }

  function editFooterLink(id) {
    const item = (currentFooter.info_links || []).find(link => link.id === id);
    if (!item) return;
    resetFooterLinkForm();
    $('#footerLinkModalTitle').text('Edit Info Link');
    $('#footerLinkId').val(item.id);
    $('#footerLinkLabel').val(item.label || '');
    $('#footerLinkHref').val(item.href || '');
    footerLinkModal.show();
  }

  function deleteFooterLink(id) {
    if (!confirm('Delete this link?')) return;
    $.post(`${landingBaseUrl}landing-page/footer-info-link-delete`, { id }, function(response) {
      if (response.success) {
        loadFooter();
      } else {
        showAlert('danger', response.message || 'Delete failed.');
      }
    }, 'json');
  }

  function resetSocialForm() {
    $('#socialLinkForm')[0].reset();
    $('#socialLinkId').val('');
  }

  function editSocialLink(id) {
    const item = (currentFooter.social_links || []).find(link => link.id === id);
    if (!item) return;
    resetSocialForm();
    $('#socialLinkModalTitle').text('Edit Social Link');
    $('#socialLinkId').val(item.id);
    $('#socialPlatform').val(item.platform || '');
    $('#socialHref').val(item.href || '');
    $('#socialIcon').val(item.icon || '');
    socialLinkModal.show();
  }

  function deleteSocialLink(id) {
    if (!confirm('Delete this link?')) return;
    $.post(`${landingBaseUrl}landing-page/footer-social-link-delete`, { id }, function(response) {
      if (response.success) {
        loadFooter();
      } else {
        showAlert('danger', response.message || 'Delete failed.');
      }
    }, 'json');
  }

  $('#previewReload').on('click', function() {
    const url = $('#previewUrl').val().trim();
    if (!url) {
      showAlert('warning', 'Preview URL is required.');
      return;
    }
    setPreviewUrl(url);
  });

  $('#navbarLogoForm').on('submit', function(e) {
    e.preventDefault();
    if (!$('#navbarLogoUrl').val()) {
      showAlert('danger', 'Please upload a navbar logo image.');
      return;
    }
    $.post(`${landingBaseUrl}landing-page/navbar-logo-update`, $(this).serialize(), function(response) {
      if (response.success) {
        showAlert('success', response.message);
        loadNavbar();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#btnAddNavLink').on('click', function() {
    $('#navLinkForm')[0].reset();
    $('#navLinkId').val('');
    navLinkModal.show();
  });

  $('#navLinkSaveBtn').on('click', function() {
    const data = {
      id: $('#navLinkId').val(),
      side: $('#navLinkSide').val(),
      label: $('#navLinkLabel').val(),
      href: $('#navLinkHref').val()
    };
    $.post(`${landingBaseUrl}landing-page/navbar-link-save`, data, function(response) {
      if (response.success) {
        navLinkModal.hide();
        loadNavbar();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#heroForm').on('submit', function(e) {
    e.preventDefault();
    if (!$('#heroBackgroundUrl').val()) {
      showAlert('danger', 'Please upload a hero background image.');
      return;
    }
    $.post(`${landingBaseUrl}landing-page/hero-update`, $(this).serialize(), function(response) {
      if (response.success) {
        showAlert('success', response.message);
        loadHero();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#featureHeaderForm').on('submit', function(e) {
    e.preventDefault();
    $.post(`${landingBaseUrl}landing-page/features-header-update`, $(this).serialize(), function(response) {
      if (response.success) {
        showAlert('success', response.message);
        loadFeatures();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#btnAddFeature').on('click', function() {
    resetFeatureForm();
    $('#featureModalTitle').text('Add Feature');
    featureModal.show();
  });

  $('#featureSaveBtn').on('click', function() {
    const payload = {
      id: $('#featureId').val(),
      title: $('#featureTitle').val(),
      description: $('#featureDescription').val(),
      position: $('#featurePosition').val(),
      icon_url: $('#featureIconUrl').val(),
      icon_type: $('#featureIconType').val(),
      icon_alt: $('#featureIconAlt').val(),
      has_image: $('#featureHasImage').is(':checked') ? '1' : '0'
    };
    $.post(`${landingBaseUrl}landing-page/features-save`, payload, function(response) {
      if (response.success) {
        featureModal.hide();
        loadFeatures();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#featureIconFile').on('change', function() {
    const file = this.files[0];
    if (!file) return;
    const formData = new FormData();
    formData.append('icon', file);
    $.ajax({
      url: `${landingBaseApi}landing-page/icon-upload`,
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        const url = normalizeUploadUrl(response);
        if (url) {
          $('#featureIconUrl').val(url);
          $('#featureIconType').val(response.type || '');
        } else if (response.error) {
          showAlert('danger', response.error);
        } else {
          showAlert('danger', 'Upload failed.');
        }
      },
      error: function(xhr) {
        const msg = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'Upload failed.';
        showAlert('danger', msg);
      }
    });
  });

  $('#navbarLogoFile').on('change', function() {
    uploadLandingImage(this.files[0], imageValidationRules.navbarLogo, function(url) {
      setImageField('#navbarLogoUrl', url, '#navbarLogoPreview');
    });
  });

  $('#heroBackgroundFile').on('change', function() {
    uploadLandingImage(this.files[0], imageValidationRules.heroBackground, function(url) {
      setImageField('#heroBackgroundUrl', url, '#heroBackgroundPreview');
    });
  });

  $('#newProductsHeaderForm').on('submit', function(e) {
    e.preventDefault();
    $.post(`${landingBaseUrl}landing-page/new-products-header-update`, $(this).serialize(), function(response) {
      if (response.success) {
        showAlert('success', response.message);
        loadNewProducts();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#btnAddProduct').on('click', function() {
    resetProductForm();
    $('#productModalTitle').text('Add Product');
    productModal.show();
  });

  $('#productSaveBtn').on('click', function() {
    if (!$('#productImage').val()) {
      showAlert('danger', 'Please upload a product image.');
      return;
    }
    const payload = {
      id: $('#productId').val(),
      name: $('#productName').val(),
      category: $('#productCategory').val(),
      description: $('#productDescription').val(),
      image: $('#productImage').val(),
      features: JSON.stringify(parseFeatureLines($('#productFeatures').val()))
    };
    $.post(`${landingBaseUrl}landing-page/new-products-save`, payload, function(response) {
      if (response.success) {
        productModal.hide();
        loadNewProducts();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#productIconUpload').on('change', function() {
    const file = this.files[0];
    if (!file) return;
    const formData = new FormData();
    formData.append('icon', file);
    $.ajax({
      url: `${landingBaseApi}landing-page/icon-upload`,
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        const url = normalizeUploadUrl(response);
        if (url) {
          $('#productIconUrl').val(url);
        } else if (response.error) {
          showAlert('danger', response.error);
        } else {
          showAlert('danger', 'Upload failed.');
        }
      },
      error: function(xhr) {
        const msg = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'Upload failed.';
        showAlert('danger', msg);
      }
    });
  });

  $('#productImageFile').on('change', function() {
    uploadLandingImage(this.files[0], imageValidationRules.productImage, function(url) {
      setImageField('#productImage', url, '#productImagePreview');
    });
  });

  $('#favoriteProductImageFile').on('change', function() {
    uploadLandingImage(this.files[0], imageValidationRules.favoriteProductImage, function(url) {
      setImageField('#favoriteProductImage', url, '#favoriteProductImagePreview');
    });
  });

  $('#favoriteMiniImageFile').on('change', function() {
    uploadLandingImage(this.files[0], imageValidationRules.favoriteMiniImage, function(url) {
      setImageField('#favoriteMiniImage', url, '#favoriteMiniImagePreview');
    });
  });

  $('#teamImageFile').on('change', function() {
    uploadLandingImage(this.files[0], imageValidationRules.teamImage, function(url) {
      setImageField('#teamImage', url, '#teamImagePreview');
    });
  });

  $('#testimonialBeforeFile').on('change', function() {
    uploadLandingImage(this.files[0], imageValidationRules.testimonialBefore, function(url) {
      setImageField('#testimonialBefore', url, '#testimonialBeforePreview');
    });
  });

  $('#testimonialAfterFile').on('change', function() {
    uploadLandingImage(this.files[0], imageValidationRules.testimonialAfter, function(url) {
      setImageField('#testimonialAfter', url, '#testimonialAfterPreview');
    });
  });

  $('#footerLogoFile').on('change', function() {
    uploadLandingImage(this.files[0], imageValidationRules.footerLogo, function(url) {
      setImageField('#footerLogoUrl', url, '#footerLogoPreview');
    });
  });

  $('#favoritesHeaderForm').on('submit', function(e) {
    e.preventDefault();
    $.post(`${landingBaseUrl}landing-page/customer-favorites-header-update`, $(this).serialize(), function(response) {
      if (response.success) {
        showAlert('success', response.message);
        loadFavorites();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#btnAddFavorite').on('click', function() {
    resetFavoriteForm();
    $('#favoriteModalTitle').text('Add Item');
    favoriteModal.show();
  });

  $('#favoriteSaveBtn').on('click', function() {
    if (!$('#favoriteProductImage').val() || !$('#favoriteMiniImage').val()) {
      showAlert('danger', 'Please upload both product and mini images.');
      return;
    }
    const payload = {
      id: $('#favoriteId').val(),
      category_heading: $('#favoriteHeading').val(),
      category_description: $('#favoriteDescription').val(),
      product_name: $('#favoriteProductName').val(),
      product_description: $('#favoriteProductDescription').val(),
      product_image: $('#favoriteProductImage').val(),
      product_mini_image: $('#favoriteMiniImage').val()
    };
    $.post(`${landingBaseUrl}landing-page/customer-favorites-save`, payload, function(response) {
      if (response.success) {
        favoriteModal.hide();
        loadFavorites();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#teamHeaderForm').on('submit', function(e) {
    e.preventDefault();
    $.post(`${landingBaseUrl}landing-page/team-header-update`, $(this).serialize(), function(response) {
      if (response.success) {
        showAlert('success', response.message);
        loadTeam();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#btnAddTeam').on('click', function() {
    resetTeamForm();
    $('#teamModalTitle').text('Add Member');
    teamModal.show();
  });

  $('#teamSaveBtn').on('click', function() {
    if (!$('#teamImage').val()) {
      showAlert('danger', 'Please upload a team member image.');
      return;
    }
    const payload = {
      id: $('#teamId').val(),
      name: $('#teamName').val(),
      role: $('#teamRole').val(),
      image: $('#teamImage').val()
    };
    $.post(`${landingBaseUrl}landing-page/team-save`, payload, function(response) {
      if (response.success) {
        teamModal.hide();
        loadTeam();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#testimonialsHeaderForm').on('submit', function(e) {
    e.preventDefault();
    $.post(`${landingBaseUrl}landing-page/testimonials-header-update`, $(this).serialize(), function(response) {
      if (response.success) {
        showAlert('success', response.message);
        loadTestimonials();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#btnAddTestimonial').on('click', function() {
    resetTestimonialForm();
    $('#testimonialModalTitle').text('Add Testimonial');
    testimonialModal.show();
  });

  $('#testimonialSaveBtn').on('click', function() {
    if (!$('#testimonialBefore').val() || !$('#testimonialAfter').val()) {
      showAlert('danger', 'Please upload both before and after images.');
      return;
    }
    const payload = {
      id: $('#testimonialId').val(),
      name: $('#testimonialName').val(),
      role: $('#testimonialRole').val(),
      before_image: $('#testimonialBefore').val(),
      after_image: $('#testimonialAfter').val(),
      content: $('#testimonialContent').val(),
      rating: $('#testimonialRating').val()
    };
    $.post(`${landingBaseUrl}landing-page/testimonials-save`, payload, function(response) {
      if (response.success) {
        testimonialModal.hide();
        loadTestimonials();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#footerForm').on('submit', function(e) {
    e.preventDefault();
    if (!$('#footerLogoUrl').val()) {
      showAlert('danger', 'Please upload a footer logo image.');
      return;
    }
    $.post(`${landingBaseUrl}landing-page/footer-update`, $(this).serialize(), function(response) {
      if (response.success) {
        showAlert('success', response.message);
        loadFooter();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#btnAddFooterLink').on('click', function() {
    resetFooterLinkForm();
    $('#footerLinkModalTitle').text('Add Info Link');
    footerLinkModal.show();
  });

  $('#footerLinkSaveBtn').on('click', function() {
    const payload = {
      id: $('#footerLinkId').val(),
      label: $('#footerLinkLabel').val(),
      href: $('#footerLinkHref').val()
    };
    $.post(`${landingBaseUrl}landing-page/footer-info-link-save`, payload, function(response) {
      if (response.success) {
        footerLinkModal.hide();
        loadFooter();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $('#btnAddSocialLink').on('click', function() {
    resetSocialForm();
    $('#socialLinkModalTitle').text('Add Social Link');
    socialLinkModal.show();
  });

  $('#socialSaveBtn').on('click', function() {
    const payload = {
      id: $('#socialLinkId').val(),
      platform: $('#socialPlatform').val(),
      href: $('#socialHref').val(),
      icon: $('#socialIcon').val()
    };
    $.post(`${landingBaseUrl}landing-page/footer-social-link-save`, payload, function(response) {
      if (response.success) {
        socialLinkModal.hide();
        loadFooter();
      } else {
        showAlert('danger', response.message || 'Save failed.');
      }
    }, 'json');
  });

  $(document).ready(function() {
    initPreview();
    loadNavbar();
    loadHero();
    loadFeatures();
    loadNewProducts();
    loadFavorites();
    loadTeam();
    loadTestimonials();
    loadFooter();

    $('.section-list .list-group-item').on('click', function() {
      const sectionKey = $(this).data('section');
      switchSection(sectionKey);
    });
  });
</script>
