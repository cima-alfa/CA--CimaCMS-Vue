export type StyleModes = {
    white: string;
    black: string;
    mono: string;
    primary: string;
    neutral: string;
    accent: string;
    actionPrimary: string;
    actionSecondary: string;
    impartial: string;
    info: string;
    success: string;
    warning: string;
    alert: string;
};

export enum StyleModeName {
    white = "white",
    black = "black",
    mono = "mono",
    primary = "primary",
    neutral = "neutral",
    accent = "accent",
    actionPrimary = "action-primary",
    actionSecondary = "action-secondary",
    impartial = "impartial",
    info = "info",
    success = "success",
    warning = "warning",
    alert = "alert",
}

export type StyleMode = `${StyleModeName}`;
