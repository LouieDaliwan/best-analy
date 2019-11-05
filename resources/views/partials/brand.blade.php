<div class="brand">
  <img
    class="brand-logo"
    width="{{ $width ?? $height ?? $size ?? '40' }}"
    height="{{ $height ?? $width ?? $size ?? '40' }}"
    src="{{ theme()->logo() }}">
  <span class="brand-title">{{ settings('site_title') }}</span>
</div>
