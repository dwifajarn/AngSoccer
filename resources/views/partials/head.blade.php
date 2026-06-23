<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://fonts.googleapis.com" rel="preconnect">
<link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "on-secondary-container": "#00731e",
                    "on-primary-container": "#9dd090",
                    "surface-container-high": "#e8e8ea",
                    "on-error-container": "#93000a",
                    "on-surface-variant": "#42493e",
                    error: "#ba1a1a",
                    "on-tertiary": "#ffffff",
                    "secondary-fixed-dim": "#78dc77",
                    "surface-tint": "#3b6934",
                    background: "#f9f9fc",
                    "on-secondary-fixed": "#002204",
                    surface: "#f9f9fc",
                    "surface-container": "#eeeef0",
                    "primary-fixed": "#bcf0ae",
                    "surface-bright": "#f9f9fc",
                    "on-tertiary-container": "#c2c2c3",
                    "primary-container": "#2d5a27",
                    "secondary-fixed": "#94f990",
                    secondary: "#006e1c",
                    "tertiary-fixed": "#e2e2e2",
                    "inverse-surface": "#2f3133",
                    "on-tertiary-fixed-variant": "#454747",
                    "on-secondary": "#ffffff",
                    "secondary-container": "#91f78e",
                    "on-background": "#1a1c1e",
                    "surface-dim": "#dadadc",
                    primary: "#154212",
                    "tertiary-fixed-dim": "#c6c6c7",
                    "surface-container-highest": "#e2e2e5",
                    "on-primary-fixed-variant": "#23501e",
                    "surface-variant": "#e2e2e5",
                    "surface-container-low": "#f3f3f6",
                    "on-surface": "#1a1c1e",
                    "on-primary": "#ffffff",
                    "on-error": "#ffffff",
                    "on-secondary-fixed-variant": "#005313",
                    "tertiary-container": "#4e5051",
                    "primary-fixed-dim": "#a1d494",
                    tertiary: "#37393a",
                    "on-tertiary-fixed": "#1a1c1c",
                    "surface-container-lowest": "#ffffff",
                    "error-container": "#ffdad6",
                    "outline-variant": "#c2c9bb",
                    "on-primary-fixed": "#002201",
                    "inverse-primary": "#a1d494",
                    outline: "#72796e",
                    "inverse-on-surface": "#f0f0f3",
                },
                borderRadius: {
                    DEFAULT: "0.25rem",
                    lg: "0.5rem",
                    xl: "0.75rem",
                    full: "9999px",
                },
                spacing: {
                    xs: "4px",
                    lg: "24px",
                    base: "4px",
                    xl: "40px",
                    gutter: "24px",
                    "margin-desktop": "48px",
                    md: "16px",
                    "margin-mobile": "16px",
                    "2xl": "64px",
                    sm: "8px",
                },
                fontFamily: {
                    "headline-lg-mobile": ["Montserrat"],
                    caption: ["Inter"],
                    "headline-lg": ["Montserrat"],
                    "headline-md": ["Montserrat"],
                    "label-md": ["Inter"],
                    "body-md": ["Inter"],
                    "display-lg": ["Montserrat"],
                    "body-lg": ["Inter"],
                },
                fontSize: {
                    "headline-lg-mobile": ["24px", { lineHeight: "32px", fontWeight: "700" }],
                    caption: ["12px", { lineHeight: "16px", fontWeight: "500" }],
                    "headline-lg": ["32px", { lineHeight: "40px", letterSpacing: "-0.01em", fontWeight: "700" }],
                    "headline-md": ["24px", { lineHeight: "32px", fontWeight: "600" }],
                    "label-md": ["14px", { lineHeight: "20px", letterSpacing: "0.05em", fontWeight: "600" }],
                    "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                    "display-lg": ["48px", { lineHeight: "56px", letterSpacing: "-0.02em", fontWeight: "700" }],
                    "body-lg": ["18px", { lineHeight: "28px", fontWeight: "400" }],
                },
            },
        },
    };
</script>

<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
</style>

@stack('styles')
