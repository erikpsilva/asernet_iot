"""Generate the thin-stroke icon set used by the camera security v2 page."""

from pathlib import Path


ICONS = {
    "arrow-right": '<path d="M4 12h16m-6-6 6 6-6 6"/>',
    "microchip": '<rect x="5" y="5" width="14" height="14" rx="2"/><rect x="9" y="9" width="6" height="6" rx="1"/><path d="M9 2v3m6-3v3M9 19v3m6-3v3M2 9h3m-3 6h3m14-6h3m-3 6h3"/>',
    "bell": '<path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9ZM10 21h4"/>',
    "cloud": '<path d="M7 18H6a4 4 0 0 1-.6-7.95A7 7 0 0 1 19 11a3.5 3.5 0 0 1-.5 7H7Z"/>',
    "user-shield": '<circle cx="9" cy="7" r="3"/><path d="M3 20v-1a6 6 0 0 1 9-5.2M16 12l5 2v3.5c0 2.4-2.2 4.1-5 5-2.8-.9-5-2.6-5-5V14l5-2Z"/><path d="m14 17 1.5 1.5L18 16"/>',
    "headset": '<path d="M4 13V11a8 8 0 0 1 16 0v2M4 13H3v5h3v-5H4Zm16 0h1v5h-3v-5h2Zm0 5a4 4 0 0 1-4 4h-4"/>',
    "eye": '<path d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6-10-6-10-6Z"/><circle cx="12" cy="12" r="2.5"/>',
    "mobile-screen-button": '<rect x="6" y="2" width="12" height="20" rx="2"/><path d="M6 5h12M6 18h12"/><circle cx="12" cy="20" r=".5" fill="currentColor" stroke="none"/>',
    "gear": '<path d="M10 2h4l.5 2.1 1.7.7 1.8-1.1 2.8 2.8-1.1 1.8.7 1.7L22 10v4l-2.1.5-.7 1.7 1.1 1.8-2.8 2.8-1.8-1.1-1.7.7L14 22h-4l-.5-2.1-1.7-.7-1.8 1.1-2.8-2.8 1.1-1.8-.7-1.7L2 14v-4l2.1-.5.7-1.7-1.1-1.8 2.8-2.8 1.8 1.1 1.7-.7L10 2Z"/><circle cx="12" cy="12" r="3"/>',
    "circle-check": '<circle cx="12" cy="12" r="9"/><path d="m8 12 2.7 2.7L16.5 9"/>',
    "bolt": '<path d="m13 2-8 11h6l-1 9 9-12h-6l.5-8Z"/>',
    "person-walking": '<circle cx="14" cy="4" r="2"/><path d="m10 21 2-5-2-4-4 2-3 4m9-2 4 2 2 4m-8-10 2-4 4 3 3 1"/>',
    "video": '<rect x="2" y="5" width="15" height="14" rx="2"/><path d="m17 10 5-3v10l-5-3"/>',
    "lightbulb": '<path d="M9 18h6m-5 3h4m-6-6c-1.7-1.2-2.5-3-2.5-5a6.5 6.5 0 1 1 13 0c0 2-.8 3.8-2.5 5l-1 3H9l-1-3Z"/>',
    "bullhorn": '<path d="M3 10h4l11-5v14L7 14H3v-4Zm4 4 2 7h4l-2-5M21 9l1-1m-1 6 1 1"/>',
    "door-open": '<path d="M4 22h16M6 22V4l12-2v20M6 6l12 2"/><circle cx="14.5" cy="13" r=".7" fill="currentColor" stroke="none"/>',
    "house-signal": '<path d="m2 11 10-8 10 8M5 10v11h14V10M9 21v-7h6v7M8 10a5.7 5.7 0 0 1 8 0m-6 2a2.8 2.8 0 0 1 4 0"/>',
    "network-wired": '<rect x="9" y="2" width="6" height="5" rx="1"/><rect x="2" y="17" width="6" height="5" rx="1"/><rect x="16" y="17" width="6" height="5" rx="1"/><path d="M12 7v5M5 17v-5h14v5"/>',
    "server": '<rect x="3" y="3" width="18" height="8" rx="2"/><rect x="3" y="13" width="18" height="8" rx="2"/><path d="M7 7h.01M7 17h.01M11 7h7m-7 10h7" stroke-linecap="round"/>',
    "car-battery": '<rect x="3" y="6" width="18" height="15" rx="2"/><path d="M7 3v3m10-3v3M7 11v5m-2.5-2.5h5M15 13.5h4"/>',
    "house-shield": '<path d="m2 11 10-8 10 8M5 10v11h7M19 10v3m-10 8v-7h4m5-1 4 1.5v3c0 2.4-1.7 4.2-4 5-2.3-.8-4-2.6-4-5v-3l4-1.5Z"/><path d="m16.5 17.5 1.1 1.1 2-2"/>',
}

output_dir = Path(__file__).resolve().parents[1] / "images" / "camerasegurancav2" / "icons"
output_dir.mkdir(parents=True, exist_ok=True)
for name, paths in ICONS.items():
    svg = (
        '<svg xmlns="http://www.w3.org/2000/svg" class="security-v2__icon" '
        'viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65" '
        'stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">'
        f'{paths}</svg>\n'
    )
    (output_dir / f"{name}.svg").write_text(svg, encoding="utf-8")
