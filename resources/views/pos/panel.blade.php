<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Panel — AutoCars Cabrera</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cabinet+Grotesk:wght@400;500;600;700;800&family=Geist+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{
    /* neutrals — warm white base */
    --bg:       #0c0c0e;
    --s1:       #111114;
    --s2:       #17171b;
    --s3:       #1e1e24;
    --s4:       #26262e;
    --b0:       rgba(255,255,255,0.055);
    --b1:       rgba(255,255,255,0.09);
    --b2:       rgba(255,255,255,0.14);
    /* brand - soft translucent blue */
    --brand:    #60a5fa;
    --brand2:   #3b82f6;
    --brand-a:  rgba(96,165,250,0.15);
    --brand-glow: rgba(96,165,250,0.25);
    /* red for alerts */
    --red:      #ef4444;
    --red2:     #dc2626;
    --red-a:    rgba(239,68,68,0.14);
    --red-glow: rgba(239,68,68,0.22);
    /* status */
    --green:    #23d18b;
    --green-a:  rgba(35,209,139,0.12);
    --amber:    #f5a623;
    --amber-a:  rgba(245,166,35,0.12);
    --blue:     #4a9eff;
    --blue-a:   rgba(74,158,255,0.12);
    /* text */
    --t0:   #f5f5f6;
    --t1:   #9898a6;
    --t2:   #52525f;
    /* layout */
    --sw:   260px;
    --font: 'Cabinet Grotesk', sans-serif;
    --mono: 'Geist Mono', monospace;
}
html,body{height:100%;background:var(--bg);color:var(--t0);font-family:var(--font);font-size:14px;line-height:1.5;-webkit-font-smoothing:antialiased;}
button{font-family:inherit;cursor:pointer;border:none;background:none;}
input,select{font-family:inherit;}
a{text-decoration:none;color:inherit;}
::-webkit-scrollbar{width:3px;}::-webkit-scrollbar-thumb{background:var(--s4);border-radius:2px;}

/* ── LAYOUT ── */
.app{display:flex;min-height:100vh;}

/* ── SIDEBAR ── */
.sb{
    width:var(--sw);flex-shrink:0;
    background:var(--s1);
    border-right:1px solid var(--b0);
    display:flex;flex-direction:column;
    padding:0;
    position:fixed;inset:0 auto 0 0;
    z-index:50;
}

.sb-logo{
    padding:22px 20px 20px;
    display:flex;align-items:center;gap:10px;
    border-bottom:1px solid var(--b0);
}
.sb-logo-mark{
    width:34px;height:34px;border-radius:9px;
    background:var(--brand-a);
    display:flex;align-items:center;justify-content:center;
    flex-shrink:0;
}
.sb-logo-mark svg{width:17px;height:17px;color:var(--brand);}
.sb-logo-text{font-size:14px;font-weight:800;letter-spacing:-.3px;line-height:1.2;}
.sb-logo-text span{color:var(--red);}
.sb-logo-text small{display:block;font-size:9.5px;font-weight:500;color:var(--t2);letter-spacing:.3px;margin-top:1px;}

.sb-mini{
    padding:14px 20px 10px;
    display:grid;grid-template-columns:1fr 1fr;gap:8px;
    border-bottom:1px solid var(--b0);
}
.sb-mini-card{
    background:var(--s2);border:1px solid var(--b0);
    border-radius:8px;padding:10px 11px;
}
.sb-mini-v{font-size:17px;font-weight:800;letter-spacing:-.5px;font-family:var(--mono);}
.sb-mini-l{font-size:10px;color:var(--t2);margin-top:2px;font-weight:500;}

.sb-nav{padding:12px 10px;flex:1;}
.nav-section{margin-bottom:4px;}
.nav-sec-lbl{font-size:9.5px;letter-spacing:1.2px;text-transform:uppercase;color:var(--t2);font-weight:600;padding:6px 10px 4px;}

.nav-item{
    display:flex;align-items:center;gap:9px;
    padding:8px 10px;border-radius:7px;
    font-size:13px;font-weight:500;color:var(--t1);
    cursor:pointer;transition:all .14s;position:relative;
    border:none;background:none;width:100%;text-align:left;
}
.nav-item svg{width:15px;height:15px;flex-shrink:0;opacity:.7;}
.nav-item:hover{color:var(--t0);background:var(--b0);}
.nav-item.active{color:var(--t0);background:var(--s3);}
.nav-item.active svg{opacity:1;}
.nav-item.active::before{
    content:'';position:absolute;left:0;top:4px;bottom:4px;
    width:2.5px;border-radius:0 2px 2px 0;background:var(--red);
}
.nav-badge{
    margin-left:auto;background:var(--red);color:#fff;
    font-size:9.5px;font-weight:700;
    padding:2px 6px;border-radius:10px;min-width:18px;text-align:center;
}

.sb-bottom{
    padding:14px 16px;
    border-top:1px solid var(--b0);
}
.user-row{display:flex;align-items:center;gap:9px;}
.user-av{
    width:30px;height:30px;border-radius:50%;
    background:linear-gradient(135deg,var(--red2),var(--red));
    display:flex;align-items:center;justify-content:center;
    font-size:11px;font-weight:800;color:#fff;flex-shrink:0;
}
.user-name{font-size:12px;font-weight:600;line-height:1.2;}
.user-role{font-size:10px;color:var(--t2);}

.btn-venta{
    margin:0 12px 14px;
    background:var(--brand);color:#fff;border-radius:9px;
    padding:11px 16px;font-size:13px;font-weight:700;
    display:flex;align-items:center;justify-content:center;gap:7px;
    transition:all .15s;letter-spacing:-.1px;
    position:relative;overflow:hidden;
}
.btn-venta::after{
    content:'';position:absolute;inset:0;
    background:rgba(255,255,255,0);transition:background .15s;
}
.btn-venta:hover::after{background:rgba(255,255,255,0.07);}
.btn-venta svg{width:14px;height:14px;}

/* ── MAIN ── */
.main{margin-left:var(--sw);flex:1;display:flex;flex-direction:column;}

/* ── TOPBAR ── */
.topbar{
    height:58px;padding:0 32px;
    display:flex;align-items:center;justify-content:space-between;
    border-bottom:1px solid var(--b0);
    background:var(--s1);
    position:sticky;top:0;z-index:40;
}
.topbar-left{}
.topbar-title{font-size:16px;font-weight:800;letter-spacing:-.4px;}
.topbar-sub{font-size:11.5px;color:var(--t2);font-weight:500;margin-top:1px;}
.topbar-right{display:flex;align-items:center;gap:10px;}

.topbar-date{
    font-size:12px;color:var(--t1);
    background:var(--s2);border:1px solid var(--b0);
    border-radius:7px;padding:6px 12px;
    display:flex;align-items:center;gap:6px;
}
.topbar-date svg{width:13px;height:13px;color:var(--t2);}

.topbar-btn{
    width:34px;height:34px;border-radius:8px;
    background:var(--s2);border:1px solid var(--b0);
    display:flex;align-items:center;justify-content:center;
    color:var(--t1);transition:all .14s;position:relative;
}
.topbar-btn svg{width:15px;height:15px;}
.topbar-btn:hover{background:var(--s3);color:var(--t0);}
.notif-dot{
    position:absolute;top:6px;right:6px;
    width:6px;height:6px;border-radius:50%;
    background:var(--red);border:1.5px solid var(--s1);
}

.btn-tpv{
    background:var(--brand-a);color:var(--brand);border-radius:8px;
    padding:8px 16px;font-size:12.5px;font-weight:700;
    display:flex;align-items:center;gap:6px;
    transition:all .15s;letter-spacing:-.1px;
}
.btn-tpv:hover{background:var(--brand);color:var(--bg);}
.btn-tpv svg{width:13px;height:13px;}

/* ── CONTENT ── */
.content{padding:28px 32px;flex:1;}

/* ── KPI GRID ── */
.kpi-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
    margin-bottom:28px;
}

.kpi{
    background:var(--s1);
    border:1px solid var(--b0);
    border-radius:13px;
    padding:20px 22px;
    position:relative;
    overflow:hidden;
    transition:border-color .15s,transform .15s;
    cursor:default;
}
.kpi:hover{border-color:var(--b1);transform:translateY(-1px);}

/* top accent line */
.kpi::before{
    content:'';
    position:absolute;top:0;left:0;right:0;height:1px;
    background:linear-gradient(90deg,transparent,var(--kpi-accent,var(--b1)),transparent);
    border-radius:13px 13px 0 0;
}
.kpi.k-green{--kpi-accent:var(--green);}
.kpi.k-red{--kpi-accent:var(--red);}
.kpi.k-amber{--kpi-accent:var(--amber);}
.kpi.k-blue{--kpi-accent:var(--blue);}

/* large background number */
.kpi-bg{
    position:absolute;right:-8px;top:50%;transform:translateY(-50%);
    font-size:80px;font-weight:800;font-family:var(--mono);
    color:rgba(255,255,255,0.025);pointer-events:none;
    letter-spacing:-4px;line-height:1;
}

.kpi-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;}
.kpi-label{font-size:10px;letter-spacing:1.2px;text-transform:uppercase;color:var(--t2);font-weight:600;}
.kpi-icon{
    width:30px;height:30px;border-radius:8px;
    display:flex;align-items:center;justify-content:center;
}
.kpi-icon svg{width:14px;height:14px;}
.kpi-icon.green{background:var(--green-a);color:var(--green);}
.kpi-icon.red{background:var(--red-a);color:var(--red);}
.kpi-icon.amber{background:var(--amber-a);color:var(--amber);}
.kpi-icon.blue{background:var(--blue-a);color:var(--blue);}

.kpi-value{
    font-size:30px;font-weight:800;letter-spacing:-1.5px;
    line-height:1;margin-bottom:8px;font-family:var(--mono);
}
.kpi-footer{display:flex;align-items:center;gap:6px;}
.kpi-badge{
    font-size:10.5px;font-weight:600;
    padding:2px 8px;border-radius:5px;
    display:inline-flex;align-items:center;gap:3px;
}
.kpi-badge.green{background:var(--green-a);color:var(--green);}
.kpi-badge.red{background:var(--red-a);color:var(--red);}
.kpi-badge.amber{background:var(--amber-a);color:var(--amber);}
.kpi-badge.blue{background:var(--blue-a);color:var(--blue);}
.kpi-sub{font-size:11px;color:var(--t2);}

/* sparkline */
.kpi-spark{
    position:absolute;bottom:0;left:0;right:0;height:36px;
    opacity:.25;pointer-events:none;
}

/* ── BOTTOM GRID ── */
.bottom-grid{
    display:grid;
    grid-template-columns:1fr 380px;
    gap:16px;
}

/* ── CARD ── */
.card{
    background:var(--s1);
    border:1px solid var(--b0);
    border-radius:13px;
    overflow:hidden;
}
.card-head{
    padding:18px 22px;
    border-bottom:1px solid var(--b0);
    display:flex;align-items:center;justify-content:space-between;
}
.card-title{font-size:13px;font-weight:700;letter-spacing:-.2px;}
.card-link{
    font-size:12px;color:var(--t2);
    display:flex;align-items:center;gap:4px;
    transition:color .14s;
}
.card-link:hover{color:var(--t0);}
.card-link svg{width:12px;height:12px;}

/* ── MOVIMIENTOS ── */
.mov-empty{
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    padding:52px 20px;color:var(--t2);text-align:center;
}
.mov-empty svg{width:36px;height:36px;margin-bottom:12px;opacity:.3;}
.mov-empty p{font-size:13px;}

.mov-item{
    display:flex;align-items:center;gap:14px;
    padding:13px 22px;
    border-bottom:1px solid var(--b0);
    transition:background .14s;
}
.mov-item:last-child{border-bottom:none;}
.mov-item:hover{background:rgba(255,255,255,.02);}
.mov-icon{
    width:34px;height:34px;border-radius:9px;
    display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.mov-icon svg{width:14px;height:14px;}
.mov-info{flex:1;min-width:0;}
.mov-name{font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.mov-meta{font-size:11px;color:var(--t2);margin-top:2px;}
.mov-amount{font-family:var(--mono);font-size:13px;font-weight:600;white-space:nowrap;}
.mov-amount.pos{color:var(--green);}
.mov-amount.neg{color:var(--red);}

/* ── REPOSICIÓN ── */
.repo-item{
    padding:14px 22px;
    border-bottom:1px solid var(--b0);
    transition:background .14s;
}
.repo-item:last-child{border-bottom:none;}
.repo-item:hover{background:rgba(255,255,255,.02);}
.repo-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;}
.repo-name{font-size:13px;font-weight:600;}
.repo-code{font-family:var(--mono);font-size:10px;color:var(--t2);margin-top:2px;}
.repo-pill{
    font-size:10.5px;font-weight:700;
    padding:3px 9px;border-radius:6px;
    display:flex;align-items:center;gap:4px;white-space:nowrap;flex-shrink:0;
}
.repo-pill.red{background:var(--red-a);color:var(--red);}
.repo-pill.amber{background:var(--amber-a);color:var(--amber);}
.repo-pill svg{width:9px;height:9px;}
.repo-bar-wrap{height:3px;background:var(--s4);border-radius:2px;overflow:hidden;}
.repo-bar{height:3px;border-radius:2px;transition:width .6s ease;}
.repo-bar.red{background:var(--red);}
.repo-bar.amber{background:var(--amber);}
.repo-footer{display:flex;justify-content:space-between;align-items:center;margin-top:7px;}
.repo-cat{font-size:10.5px;color:var(--t2);}
.repo-min{font-size:10.5px;color:var(--t2);}

/* ── CHART STRIP ── */
.chart-strip{
    background:var(--s1);
    border:1px solid var(--b0);
    border-radius:13px;
    padding:20px 22px;
    margin-bottom:16px;
}
.chart-strip-head{
    display:flex;align-items:center;justify-content:space-between;
    margin-bottom:16px;
}
.chart-strip-title{font-size:13px;font-weight:700;letter-spacing:-.2px;}
.chart-strip-tabs{display:flex;gap:2px;background:var(--s2);border-radius:6px;padding:2px;}
.chart-tab{
    padding:4px 10px;border-radius:4px;font-size:11px;font-weight:600;
    color:var(--t2);cursor:pointer;transition:all .14s;
}
.chart-tab.active{background:var(--s4);color:var(--t0);}
.chart-area{height:80px;position:relative;}
canvas#mainChart{width:100%!important;}

/* ── ACTIVITY ROW ── */
.activity-row{
    display:grid;grid-template-columns:1fr 1fr;
    gap:16px;margin-bottom:16px;
}
.act-card{
    background:var(--s1);border:1px solid var(--b0);
    border-radius:13px;padding:18px 20px;
}
.act-title{font-size:12px;font-weight:700;letter-spacing:-.1px;margin-bottom:14px;display:flex;align-items:center;gap:6px;}
.act-title .dot{width:6px;height:6px;border-radius:50%;}
.act-list{display:flex;flex-direction:column;gap:10px;}
.act-item{display:flex;align-items:center;justify-content:space-between;}
.act-name{font-size:12px;color:var(--t1);}
.act-val{font-size:12px;font-weight:600;font-family:var(--mono);}
.act-bar-row{display:flex;align-items:center;gap:8px;margin-top:4px;}
.act-bar-wrap{flex:1;height:3px;background:var(--s3);border-radius:2px;overflow:hidden;}
.act-bar{height:3px;border-radius:2px;}

/* ── SIDEBAR EXPANDED ── */
.sb{overflow-y:auto;overflow-x:hidden;}
.sb-logo-mark{
    background:var(--brand-a);
    box-shadow:none;
}
.sb-logo-text{font-size:15px;font-weight:800;letter-spacing:-.4px;}
.sb-logo-text small{font-size:10px;letter-spacing:.5px;text-transform:uppercase;opacity:.5;}

/* stats grid 2x3 */
.sb-stats{
    padding:12px 14px 10px;
    display:grid;grid-template-columns:1fr 1fr;gap:6px;
    border-bottom:1px solid var(--b0);
}
.sb-stat{
    background:var(--s2);border:1px solid var(--b0);
    border-radius:8px;padding:9px 10px;
    position:relative;overflow:hidden;transition:border-color .15s;
}
.sb-stat:hover{border-color:var(--b2);}
.sb-stat-v{font-size:18px;font-weight:800;letter-spacing:-.5px;font-family:var(--mono);line-height:1;}
.sb-stat-l{font-size:9.5px;color:var(--t2);margin-top:3px;font-weight:500;display:flex;align-items:center;gap:4px;}
.sb-stat-dot{width:5px;height:5px;border-radius:50%;flex-shrink:0;}

/* quick actions */
.sb-actions{padding:10px 14px;border-bottom:1px solid var(--b0);}
.sb-actions-title{font-size:9.5px;letter-spacing:1.2px;text-transform:uppercase;color:var(--t2);font-weight:600;padding:2px 0 6px;}
.sb-actions-grid{display:flex;flex-direction:column;gap:3px;}
.sb-action{
    display:flex;align-items:center;gap:8px;
    padding:7px 9px;border-radius:7px;
    font-size:12px;font-weight:600;color:var(--t1);
    cursor:pointer;transition:all .14s;
    border:1px solid transparent;width:100%;text-align:left;
}
.sb-action svg{width:14px;height:14px;flex-shrink:0;}
.sb-action:hover{color:var(--t0);background:var(--b0);border-color:var(--b0);}
.sb-action .act-icon{
    width:26px;height:26px;border-radius:6px;
    display:flex;align-items:center;justify-content:center;flex-shrink:0;
}

/* activity feed */
.sb-feed{padding:10px 14px;border-bottom:1px solid var(--b0);}
.sb-feed-title{font-size:9.5px;letter-spacing:1.2px;text-transform:uppercase;color:var(--t2);font-weight:600;padding:2px 0 8px;}
.sb-feed-list{display:flex;flex-direction:column;gap:2px;max-height:160px;overflow-y:auto;}
.sb-feed-item{
    display:flex;align-items:flex-start;gap:8px;
    padding:6px 8px;border-radius:6px;transition:background .14s;
}
.sb-feed-item:hover{background:var(--b0);}
.sb-feed-dot{
    width:6px;height:6px;border-radius:50%;flex-shrink:0;margin-top:5px;
}
.sb-feed-text{font-size:11.5px;color:var(--t1);line-height:1.35;}
.sb-feed-time{font-size:10px;color:var(--t2);font-family:var(--mono);margin-top:1px;}
.sb-feed-empty{font-size:11px;color:var(--t2);padding:8px;text-align:center;}

/* featured products */
.sb-featured{padding:10px 14px;border-bottom:1px solid var(--b0);}
.sb-featured-title{font-size:9.5px;letter-spacing:1.2px;text-transform:uppercase;color:var(--t2);font-weight:600;padding:2px 0 8px;}
.sb-featured-list{display:flex;flex-direction:column;gap:2px;}
.sb-featured-item{
    display:flex;align-items:center;justify-content:space-between;
    padding:6px 8px;border-radius:6px;transition:background .14s;cursor:pointer;
}
.sb-featured-item:hover{background:var(--b0);}
.sb-featured-name{font-size:12px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:140px;}
.sb-featured-price{font-size:11px;font-weight:700;font-family:var(--mono);color:var(--green);}
.sb-featured-stock{font-size:10px;color:var(--t2);margin-top:1px;}

/* alert banner */
.sb-alert{
    margin:10px 14px;padding:10px 12px;
    background:var(--red-a);
    border:1px solid rgba(240,52,26,0.2);
    border-radius:8px;
    display:flex;align-items:flex-start;gap:8px;
    animation:alertPulse 3s ease-in-out infinite;
}
.sb-alert svg{width:14px;height:14px;flex-shrink:0;color:var(--red);margin-top:1px;}
.sb-alert-text{font-size:11.5px;color:var(--t0);line-height:1.3;}
.sb-alert-text strong{color:var(--red);font-weight:700;}
.sb-alert-text a{color:var(--red);text-decoration:underline;font-weight:600;}
@keyframes alertPulse{0%,100%{opacity:1;}50%{opacity:.75;}}

/* modal */
.sb-modal-overlay{
    position:fixed;inset:0;background:rgba(0,0,0,0.6);
    z-index:200;display:none;align-items:center;justify-content:center;
    backdrop-filter:blur(4px);
}
.sb-modal-overlay.show{display:flex;}
.sb-modal{
    background:var(--s1);border:1px solid var(--b1);
    border-radius:14px;width:420px;max-width:90vw;
    padding:28px;position:relative;
}
.sb-modal h3{font-size:16px;font-weight:800;margin-bottom:18px;letter-spacing:-.3px;}
.sb-modal-close{
    position:absolute;top:14px;right:14px;
    width:28px;height:28px;border-radius:6px;
    display:flex;align-items:center;justify-content:center;
    color:var(--t2);cursor:pointer;transition:all .14s;
}
.sb-modal-close:hover{background:var(--s3);color:var(--t0);}
.sb-modal-close svg{width:14px;height:14px;}
.sb-field{margin-bottom:12px;}
.sb-field label{display:block;font-size:11px;font-weight:600;color:var(--t2);margin-bottom:4px;text-transform:uppercase;letter-spacing:.5px;}
.sb-field input,.sb-field select{
    width:100%;padding:9px 12px;
    background:var(--s2);border:1px solid var(--b1);
    border-radius:7px;color:var(--t0);font-size:13px;
    transition:border-color .14s;outline:none;
}
.sb-field input:focus,.sb-field select:focus{border-color:var(--red);}
.sb-field-row{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.sb-modal-btn{
    width:100%;padding:11px;margin-top:6px;
    background:var(--red);color:#fff;border-radius:8px;
    font-size:13px;font-weight:700;cursor:pointer;
    transition:all .15s;border:none;
}
.sb-modal-btn:hover{background:var(--red2);}
.sb-modal-msg{
    padding:8px 12px;border-radius:6px;margin-top:10px;
    font-size:12px;font-weight:600;display:none;
}
.sb-modal-msg.success{display:block;background:var(--green-a);color:var(--green);}
.sb-modal-msg.error{display:block;background:var(--red-a);color:var(--red);}

/* ── NOISE TEXTURE ── */
.app::after{
    content:'';
    position:fixed;inset:0;pointer-events:none;z-index:100;
    opacity:.025;
    background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
}
</style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="app()" x-init="init()">
<div class="app">

<!-- ══ SIDEBAR ══ -->
<aside class="sb">
    <div class="sb-logo">
        <div class="sb-logo-mark">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 3v3m0 12v3M3 12h3m12 0h3"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <div class="sb-logo-text">AutoCars <span style="color:var(--brand)">Cabrera</span><small>Sistema POS v3.0</small></div>
    </div>

    <!-- STATS GRID 2x3 -->
    <div class="sb-stats">
        <div class="sb-stat">
            <div class="sb-stat-v" style="color:var(--green)">S/{{ number_format($ventasHoy ?? 0, 0) }}</div>
            <div class="sb-stat-l"><span class="sb-stat-dot" style="background:var(--green)"></span> Ventas hoy</div>
        </div>
        <div class="sb-stat">
            <div class="sb-stat-v">{{ $totalProductos ?? 0 }}</div>
            <div class="sb-stat-l"><span class="sb-stat-dot" style="background:var(--blue)"></span> Productos</div>
        </div>
        <div class="sb-stat">
            <div class="sb-stat-v" style="color:var(--amber)">{{ $stockBajo ?? 0 }}</div>
            <div class="sb-stat-l"><span class="sb-stat-dot" style="background:var(--amber)"></span> Stock bajo</div>
        </div>
        <div class="sb-stat">
            <div class="sb-stat-v" style="color:var(--red)">{{ $stockCritico ?? 0 }}</div>
            <div class="sb-stat-l"><span class="sb-stat-dot" style="background:var(--red)"></span> Críticos</div>
        </div>
        <div class="sb-stat">
            <div class="sb-stat-v" style="color:var(--amber)">{{ $totalClientes ?? 0 }}</div>
            <div class="sb-stat-l"><span class="sb-stat-dot" style="background:var(--amber)"></span> Clientes</div>
        </div>
        <div class="sb-stat">
            <div class="sb-stat-v">{{ $ventasHoyCount ?? 0 }}</div>
            <div class="sb-stat-l"><span class="sb-stat-dot" style="background:var(--green)"></span> Movimientos</div>
        </div>
    </div>

    <!-- ALERT BANNER -->
    @if(($stockCritico ?? 0) > 0)
    <div class="sb-alert">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        <div class="sb-alert-text">
            <strong>{{ $stockCritico }} producto{{ $stockCritico > 1 ? 's' : '' }}</strong> con stock crítico.
            <a href="{{ route('inventario.index') }}">Revisar inventario</a>
        </div>
    </div>
    @endif

    <!-- NAV -->
    <div class="sb-nav">
        <div class="nav-section">
            <div class="nav-sec-lbl">Navegación</div>
            <button @click="page='panel'" class="nav-item" :class="page==='panel'?'active':''">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                Panel
            </button>
            <button @click="page='clientes'" class="nav-item" :class="page==='clientes'?'active':''">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Directorio
            </button>
            <button @click="page='inventario'" class="nav-item" :class="page==='inventario'?'active':''">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                Inventario
            </button>
                <!-- @if(($stockCritico ?? 0) > 0)<span class="nav-badge">{{ $stockCritico }}</span>@endif -->
            <a href="{{ url('/') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                Punto de Venta
            </button>
        </div>
    </div>

    <!-- QUICK ACTIONS -->
    <div class="sb-actions">
        <div class="sb-actions-title">Acciones rápidas</div>
        <div class="sb-actions-grid">
            <button class="sb-action" onclick="openModal('modalProducto')">
                <span class="act-icon" style="background:var(--green-a);color:var(--green)"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                Nuevo producto
            </button>
            <button class="sb-action" onclick="openModal('modalStock')">
                <span class="act-icon" style="background:var(--blue-a);color:var(--blue)"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg></span>
                Agregar stock
            </button>
            <button @click="page='pos'" class="sb-action">
                <span class="act-icon" style="background:var(--brand-a);color:var(--brand)"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg></span>
                Nueva venta
            </button>
        </div>
    </div>

    <!-- ACTIVITY FEED -->
    <div class="sb-feed">
        <div class="sb-feed-title">Actividad reciente</div>
        <div class="sb-feed-list">
            @forelse(($movimientos ?? collect())->take(5) as $m)
            <div class="sb-feed-item">
                <span class="sb-feed-dot" style="background:{{ $m->tipo === 'ingreso' ? 'var(--green)' : 'var(--red)' }}"></span>
                <div>
                    <div class="sb-feed-text">{{ $m->concepto ?? 'Movimiento registrado' }}</div>
                    <div class="sb-feed-time">S/{{ number_format($m->monto, 2) }} · {{ $m->created_at?->diffForHumans() ?? '' }}</div>
                </div>
            </div>
            @empty
            <div class="sb-feed-empty">Sin actividad reciente</div>
            @endforelse
        </div>
    </div>

    <!-- FEATURED PRODUCTS -->
    @if(($productosDestacados ?? collect())->count() > 0)
    <div class="sb-featured">
        <div class="sb-featured-title">Productos destacados</div>
        <div class="sb-featured-list">
            @foreach(($productosDestacados ?? collect())->take(5) as $pd)
            <a href="{{ route('inventario.index') }}" class="sb-featured-item">
                <div>
                    <div class="sb-featured-name">{{ $pd->nombre }}</div>
                    <div class="sb-featured-stock">Stock: {{ $pd->stock }} · {{ $pd->categoria ?? '' }}</div>
                </div>
                <div class="sb-featured-price">S/{{ number_format($pd->precio1, 0) }}</div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- USER -->
    <div class="sb-bottom" style="margin-top:auto;">
        <div class="user-row">
            <div class="user-av">EC</div>
            <div>
                <div class="user-name">Estrella Cabrera L.</div>
                <div class="user-role">Gestor del sistema</div>
            </div>
        </div>
    </div>
</aside>

<!-- MODAL: Nuevo Producto -->
<div class="sb-modal-overlay" id="modalProducto">
    <div class="sb-modal">
        <button class="sb-modal-close" onclick="closeModal('modalProducto')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        <h3>Nuevo Producto</h3>
        <form id="formProducto" onsubmit="return saveProducto(event)">
            <div class="sb-field"><label>Nombre</label><input type="text" name="nombre" required></div>
            <div class="sb-field-row">
                <div class="sb-field"><label>Código</label><input type="text" name="codigo"></div>
                <div class="sb-field"><label>Categoría</label><input type="text" name="categoria"></div>
            </div>
            <div class="sb-field-row">
                <div class="sb-field"><label>Precio</label><input type="number" step="0.01" name="precio1" required></div>
                <div class="sb-field"><label>Stock</label><input type="number" name="stock" required></div>
            </div>
            <div class="sb-field-row">
                <div class="sb-field"><label>Stock Mín</label><input type="number" name="stockMin" value="5"></div>
                <div class="sb-field"><label>Marca</label><input type="text" name="marca"></div>
            </div>
            <button type="submit" class="sb-modal-btn">Guardar producto</button>
            <div class="sb-modal-msg" id="msgProducto"></div>
        </form>
    </div>
</div>

<!-- MODAL: Agregar Stock -->
<div class="sb-modal-overlay" id="modalStock">
    <div class="sb-modal">
        <button class="sb-modal-close" onclick="closeModal('modalStock')"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        <h3>Agregar Stock</h3>
        <form id="formStock" onsubmit="return addStock(event)">
            <div class="sb-field">
                <label>Producto</label>
                <select name="producto_id" id="stockProductoSelect" required>
                    <option value="">Seleccionar producto...</option>
                </select>
            </div>
            <div class="sb-field"><label>Cantidad a agregar</label><input type="number" name="cantidad" min="1" required></div>
            <button type="submit" class="sb-modal-btn">Actualizar stock</button>
            <div class="sb-modal-msg" id="msgStock"></div>
        </form>
    </div>
</div>

<!-- ══ MAIN ══ -->
<div class="main">

    <!-- TOPBAR -->
    <header class="topbar">
        <div class="topbar-left">
            <div class="topbar-title" x-text="{'panel':'Panel de Control','clientes':'Directorio de Clientes','inventario':'Inventario','pos':'Terminal TPV','caja':'Caja'}[page]||page"></div>
            <div class="topbar-sub">Visión general · {{ now()->isoFormat('dddd, D [de] MMMM') ?? 'jueves, 19 de marzo' }}</div>
        </div>
        <div class="topbar-right">
            <div class="topbar-date">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                {{ now()->format('H:i') ?? '09:00' }}
            </div>
            <button class="topbar-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                <span class="notif-dot"></span>
            </button>
            <button @click="page='pos'" class="btn-tpv">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                Nueva Venta
            </button>
        </div>
    </header>

    <!-- CONTENT -->
    <div class="content">

        <div x-show="page==='panel'">
<!-- KPI GRID -->
        <div class="kpi-grid">

            <div class="kpi k-green">
                <div class="kpi-bg">0</div>
                <div class="kpi-top">
                    <div class="kpi-label">Ingresos hoy</div>
                    <div class="kpi-icon green">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                </div>
                <div class="kpi-value">S/ 0.00</div>
                <div class="kpi-footer">
                    <span class="kpi-badge green">— 0 transacciones</span>
                </div>
                <svg class="kpi-spark" viewBox="0 0 200 36" preserveAspectRatio="none">
                    <polyline fill="none" stroke="var(--green)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" points="0,28 40,24 80,20 120,22 160,16 200,18"/>
                </svg>
            </div>

            <div class="kpi k-blue">
                <div class="kpi-bg">0</div>
                <div class="kpi-top">
                    <div class="kpi-label">Saldo en caja</div>
                    <div class="kpi-icon blue">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
                    </div>
                </div>
                <div class="kpi-value">S/ 0.00</div>
                <div class="kpi-footer">
                    <span class="kpi-sub">Ingresos − egresos</span>
                </div>
                <svg class="kpi-spark" viewBox="0 0 200 36" preserveAspectRatio="none">
                    <polyline fill="none" stroke="var(--blue)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" points="0,18 50,16 100,18 150,16 200,18"/>
                </svg>
            </div>

            <div class="kpi k-amber">
                <div class="kpi-bg">{{ $totalClientes ?? 3 }}</div>
                <div class="kpi-top">
                    <div class="kpi-label">Clientes</div>
                    <div class="kpi-icon amber">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    </div>
                </div>
                <div class="kpi-value">{{ $totalClientes ?? 3 }}</div>
                <div class="kpi-footer">
                    <span class="kpi-badge amber">— Registros activos</span>
                </div>
                <svg class="kpi-spark" viewBox="0 0 200 36" preserveAspectRatio="none">
                    <polyline fill="none" stroke="var(--amber)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" points="0,22 60,20 100,18 140,22 180,19 200,20"/>
                </svg>
            </div>

            <div class="kpi k-red">
                <div class="kpi-bg">{{ $stockCritico ?? 2 }}</div>
                <div class="kpi-top">
                    <div class="kpi-label">Stock crítico</div>
                    <div class="kpi-icon red">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                </div>
                <div class="kpi-value" style="color:var(--red)">{{ $stockCritico ?? 2 }}</div>
                <div class="kpi-footer">
                    <span class="kpi-badge red">— Bajo mínimo</span>
                </div>
                <svg class="kpi-spark" viewBox="0 0 200 36" preserveAspectRatio="none">
                    <polyline fill="none" stroke="var(--red)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" points="0,10 50,14 100,12 150,16 200,12"/>
                </svg>
            </div>

        </div><!-- /kpi-grid -->

        <!-- CHART STRIP -->
        <div class="chart-strip">
            <div class="chart-strip-head">
                <div class="chart-strip-title">Actividad de ventas</div>
                <div class="chart-strip-tabs">
                    <div class="chart-tab active" onclick="setChartTab(this,'hoy')">Hoy</div>
                    <div class="chart-tab" onclick="setChartTab(this,'sem')">Semana</div>
                    <div class="chart-tab" onclick="setChartTab(this,'mes')">Mes</div>
                </div>
            </div>
            <div class="chart-area">
                <canvas id="mainChart" height="80"></canvas>
            </div>
        </div>

        <!-- ACTIVITY ROW -->
        <div class="activity-row">
            <div class="act-card">
                <div class="act-title">
                    <span class="dot" style="background:var(--amber)"></span>
                    Top categorías
                </div>
                <div class="act-list">
                    @php
                    $cats = $categoriaStats ?? [
                        ['nombre'=>'Lubricantes','pct'=>35,'color'=>'var(--green)'],
                        ['nombre'=>'Frenos','pct'=>22,'color'=>'var(--blue)'],
                        ['nombre'=>'Accesorios','pct'=>18,'color'=>'var(--amber)'],
                        ['nombre'=>'Filtros','pct'=>15,'color'=>'var(--red)'],
                        ['nombre'=>'Transmisión','pct'=>10,'color'=>'var(--t2)'],
                    ];
                    @endphp
                    @foreach($cats as $cat)
                    <div>
                        <div class="act-item">
                            <span class="act-name">{{ $cat['nombre'] }}</span>
                            <span class="act-val">{{ $cat['pct'] }}%</span>
                        </div>
                        <div class="act-bar-row">
                            <div class="act-bar-wrap">
                                <div class="act-bar" style="width:{{ $cat['pct'] }}%;background:{{ $cat['color'] }}"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="act-card">
                <div class="act-title">
                    <span class="dot" style="background:var(--blue)"></span>
                    Resumen del día
                </div>
                <div class="act-list">
                    <div class="act-item"><span class="act-name">Ventas realizadas</span><span class="act-val">0</span></div>
                    <div class="act-item"><span class="act-name">Productos vendidos</span><span class="act-val">0</span></div>
                    <div class="act-item"><span class="act-name">Ticket promedio</span><span class="act-val" style="color:var(--green)">S/ 0.00</span></div>
                    <div class="act-item"><span class="act-name">Nuevos clientes</span><span class="act-val">0</span></div>
                    <div class="act-item"><span class="act-name">Alertas de stock</span><span class="act-val" style="color:var(--red)">{{ $stockCritico ?? 2 }}</span></div>
                </div>
            </div>
        </div>

        <!-- BOTTOM GRID -->
        <div class="bottom-grid">

            <!-- ÚLTIMOS MOVIMIENTOS -->
            <div class="card">
                <div class="card-head">
                    <div class="card-title">Últimos movimientos</div>
                    <a href="#" class="card-link">
                        Ver todos
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                </div>

                @if(($movimientos ?? collect())->isEmpty())
                <div class="mov-empty">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    <p>No hay transacciones registradas hoy</p>
                </div>
                @else
                @foreach($movimientos->take(6) as $mov)
                <div class="mov-item">
                    <div class="mov-icon" style="background:{{ $mov->tipo === 'venta' ? 'var(--green-a)' : 'var(--red-a)' }};color:{{ $mov->tipo === 'venta' ? 'var(--green)' : 'var(--red)' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="{{ $mov->tipo === 'venta' ? '23 6 13.5 15.5 8.5 10.5 1 18' : '23 18 13.5 8.5 8.5 13.5 1 6' }}"/></svg>
                    </div>
                    <div class="mov-info">
                        <div class="mov-name">{{ $mov->descripcion ?? 'Movimiento' }}</div>
                        <div class="mov-meta">{{ $mov->created_at?->format('H:i') }} · {{ $mov->tipo }}</div>
                    </div>
                    <div class="mov-amount {{ $mov->tipo === 'venta' ? 'pos' : 'neg' }}">
                        {{ $mov->tipo === 'venta' ? '+' : '-' }}S/ {{ number_format($mov->monto, 2) }}
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <!-- REPOSICIÓN URGENTE -->
            <div class="card">
                <div class="card-head">
                    <div class="card-title" style="display:flex;align-items:center;gap:6px;">
                        <svg width="13" height="13" fill="none" stroke="var(--red)" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg>
                        Reposición urgente
                    </div>
                    <a href="{{ route('inventario.index') ?? '#' }}" class="card-link">
                        Ver inventario
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                </div>

                @forelse($productosReposicion ?? [] as $p)
                @php
                    $pct = $p->stock_minimo > 0 ? min(100, round($p->stock / $p->stock_minimo * 100)) : 0;
                    $color = $p->stock <= 2 ? 'red' : 'amber';
                @endphp
                <div class="repo-item">
                    <div class="repo-top">
                        <div>
                            <div class="repo-name">{{ $p->nombre }}</div>
                            <div class="repo-code">{{ $p->codigo ?? 'Sin código' }}</div>
                        </div>
                        <span class="repo-pill {{ $color }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $p->stock }} {{ $p->unidad_medida ?? 'und' }}
                        </span>
                    </div>
                    <div class="repo-bar-wrap">
                        <div class="repo-bar {{ $color }}" style="width:{{ $pct }}%"></div>
                    </div>
                    <div class="repo-footer">
                        <span class="repo-cat">{{ $p->categoria }}</span>
                        <span class="repo-min">mín {{ $p->stock_minimo ?? 5 }}</span>
                    </div>
                </div>
                @empty
                {{-- fallback con datos reales de la imagen --}}
                <div class="repo-item">
                    <div class="repo-top">
                        <div>
                            <div class="repo-name">Faro Delantero LED Ojo de Ángel 7 Pulgadas</div>
                            <div class="repo-code">ACC-101 · HJG</div>
                        </div>
                        <span class="repo-pill red">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            1 und
                        </span>
                    </div>
                    <div class="repo-bar-wrap"><div class="repo-bar red" style="width:10%"></div></div>
                    <div class="repo-footer"><span class="repo-cat">Accesorios</span><span class="repo-min">mín 2</span></div>
                </div>
                <div class="repo-item">
                    <div class="repo-top">
                        <div>
                            <div class="repo-name">Kit de Arrastre Racing (Cadena+Piñón+Corona)</div>
                            <div class="repo-code">TRA-005 · RIZOMA</div>
                        </div>
                        <span class="repo-pill amber">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            2 kit
                        </span>
                    </div>
                    <div class="repo-bar-wrap"><div class="repo-bar amber" style="width:25%"></div></div>
                    <div class="repo-footer"><span class="repo-cat">Transmisión</span><span class="repo-min">mín 5</span></div>
                </div>
                @endforelse
            </div>

        </div><!-- /bottom-grid -->
</div><!-- /x-show panel -->

<!-- ===== CLIENTES ===== -->
      <div x-show="page==='clientes'" class="space-y-5" style="display:none;">
        <div class="flex items-center justify-between bg-card p-4 border border-border-light">
          <div class="relative w-80">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input x-model="busqCliente" placeholder="Buscar por nombre, RUC..." class="pl-9">
          </div>
          <button class="btn-primary py-2 px-5" @click="modalCliente=true;editCliente=null;formC={razon:'',comercial:'',tipoDoc:'RUC',nroDoc:'',telefono:'',email:'',direccion:'',distrito:'',ciudad:'Lima',credDias:0,limCredito:0,listaPrecio:'1',estado:'activo',notas:''}">
            + Nuevo Cliente
          </button>
        </div>
        <div class="bg-card border border-border-light overflow-hidden shadow-2xl">
          <div x-show="clientesFiltrados().length===0" class="text-center py-12 text-muted">Ningún cliente encontrado.</div>
          <table x-show="clientesFiltrados().length>0">
            <thead><tr><th>Doc</th><th>Razón Social</th><th>Teléfono</th><th>Estado</th><th class="text-right">Acciones</th></tr></thead>
            <tbody>
              <template x-for="c in clientesFiltrados()" :key="c.id">
                <tr>
                  <td><span class="badge bg-white/5 border-white/10 text-muted text-[10px]" x-text="c.tipoDoc+' '+c.nroDoc"></span></td>
                  <td class="font-bold text-white" x-text="c.razon"></td>
                  <td class="text-muted" x-text="c.telefono||'--'"></td>
                  <td><span class="badge" :class="c.estado==='activo'?'badge-ok':'badge-low'" x-text="c.estado"></span></td>
                  <td class="text-right space-x-2">
                    <button @click="abrirEditCliente(c)" class="text-accent hover:text-white p-1.5 bg-accent/5 rounded hover:bg-accent/20 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                    <button @click="eliminarCliente(c.id)" class="text-primary hover:text-white p-1.5 bg-primary/5 rounded hover:bg-primary/20 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>

      
<!-- ===== INVENTARIO ===== -->
      <div x-show="page==='inventario'" class="space-y-5" style="display:none;">
        <div class="flex items-center justify-between bg-card p-4 border border-border-light">
          <div class="relative w-80">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input x-model="busqInv" placeholder="Buscar por código o nombre..." class="pl-9">
          </div>
          <button class="btn-primary py-2 px-5" @click="formI={codigo:'',nombre:'',categoria:'Lubricantes',marca:'',unidad:'Unidad',precio1:'',precio2:'',precio3:'',stock:0,stockMin:0,stockMax:0,ubicacion:'',estado:'activo'};editInv=null;modalInv=true">
            + Nuevo Producto
          </button>
        </div>
        <div class="bg-card border border-border-light overflow-hidden shadow-2xl">
          <table>
            <thead><tr><th>Código</th><th>Producto</th><th>Categoría</th><th>Precio</th><th>Stock</th><th class="text-right">Acciones</th></tr></thead>
            <tbody>
              <template x-for="p in invFiltrado()" :key="p.id">
                <tr>
                  <td><span class="badge bg-white/5 border-white/10 text-muted text-[10px]" x-text="p.codigo"></span></td>
                  <td class="font-bold text-white truncate max-w-xs" x-text="p.nombre"></td>
                  <td class="text-muted" x-text="p.categoria"></td>
                  <td class="font-display font-bold text-white" x-text="'S/ '+parseFloat(p.precio1).toFixed(2)"></td>
                  <td><span class="badge text-[10px]" :class="p.stock<=0?'badge-low':p.stock<=p.stockMin?'badge-warn':'badge-ok'" x-text="p.stock+' '+p.unidad"></span></td>
                  <td class="text-right space-x-2">
                    <button @click="abrirEditInv(p)" class="text-accent hover:text-white p-1.5 bg-accent/5 rounded hover:bg-accent/20 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                    <button @click="eliminarProd(p.id)" class="text-primary hover:text-white p-1.5 bg-primary/5 rounded hover:bg-primary/20 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
          <div x-show="invFiltrado().length===0" class="text-center py-12 text-muted">No se encontraron productos.</div>
        </div>
      </div>

      
<!-- ===== PUNTO DE VENTA (POS) ===== -->
      <div x-show="page==='pos'" class="flex gap-5 overflow-hidden" style="display:none; height: calc(100vh - 140px);">
        <!-- Product Catalog -->
        <div class="flex-1 flex flex-col bg-surface/50 rounded-2xl border border-border-light overflow-hidden">
          <div class="p-4 border-b border-border-light">
            <div class="relative mb-3">
              <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
              <input x-model="posBusq" type="text" placeholder="Buscar producto por código o nombre..." class="w-full pl-10 py-3 text-base" @keydown.enter.prevent="agregarPorBusqueda()">
            </div>
            <div class="flex gap-2 overflow-x-auto pb-1" style="scrollbar-width:none;">
              <button class="badge px-4 py-1.5 text-[10px] font-bold uppercase tracking-widest whitespace-nowrap cursor-pointer transition-colors" :class="posCategoria===''?'bg-primary text-white border-primary/50':'bg-surface border-border-light text-muted hover:bg-white/10'" @click="posCategoria=''">Todos</button>
              <template x-for="cat in [...new Set(inventario.map(i=>i.categoria).filter(Boolean))]">
                <button class="badge px-4 py-1.5 text-[10px] font-bold uppercase tracking-widest whitespace-nowrap cursor-pointer transition-colors" @click="posCategoria=cat" :class="posCategoria===cat?'bg-white/20 text-white border-white/30':'bg-surface border-border-light text-muted hover:bg-white/10'" x-text="cat"></button>
              </template>
            </div>
          </div>
          <div class="flex-1 overflow-y-auto p-4">
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
              <template x-for="p in inventario.filter(i=>(!posCategoria||i.categoria===posCategoria)&&(i.nombre.toLowerCase().includes(posBusq.toLowerCase())||i.codigo.toLowerCase().includes(posBusq.toLowerCase())))">
                <div class="bg-card border border-border-light rounded-xl p-4 cursor-pointer hover:border-accent hover:shadow-[0_0_15px_rgba(255,184,0,0.2)] hover:-translate-y-0.5 transition-all flex flex-col relative" @click="agregarAlCarrito(p)">
                  <div class="absolute top-0 right-0 p-2"><span class="badge text-[10px]" :class="p.stock<=0?'badge-low':p.stock<=p.stockMin?'badge-warn':''" x-text="p.stock+' ud'"></span></div>
                  <div class="w-10 h-10 bg-base rounded-full border border-border-light flex items-center justify-center text-muted mb-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                  </div>
                  <p class="font-bold text-sm text-white mb-2 flex-1 line-clamp-2" x-text="p.nombre"></p>
                  <div class="flex items-end justify-between mt-2 pt-2 border-t border-white/10">
                    <p class="text-[10px] uppercase text-muted font-bold" x-text="p.codigo"></p>
                    <p class="font-display font-bold text-white text-lg" x-text="'S/ '+parseFloat(p.precio1).toFixed(2)"></p>
                  </div>
                </div>
              </template>
              <div x-show="inventario.filter(i=>(!posCategoria||i.categoria===posCategoria)&&(i.nombre.toLowerCase().includes(posBusq.toLowerCase())||i.codigo.toLowerCase().includes(posBusq.toLowerCase()))).length===0" class="col-span-full py-16 text-center text-muted">
                No se encontraron productos.
              </div>
            </div>
          </div>
        </div>

        <!-- Cart -->
        <div class="w-96 flex flex-col bg-surface/90 rounded-2xl border border-border-light overflow-hidden flex-shrink-0">
          <div class="p-4 border-b border-border-light bg-base/50">
            <label class="text-[10px] text-muted uppercase tracking-widest block mb-1 font-bold">Cliente</label>
            <select x-model="posClienteId" class="w-full text-sm">
              <option value="">Cliente Genérico (Boleta)</option>
              <template x-for="c in clientes">
                <option :value="c.id" x-text="c.razon+' ('+c.nroDoc+')'"></option>
              </template>
            </select>
          </div>

          <div class="flex-1 overflow-y-auto">
            <div class="px-4 py-3 bg-base/80 border-b border-border-light flex justify-between items-center sticky top-0 z-10">
              <span class="text-[10px] font-bold text-muted uppercase tracking-widest">Orden</span>
              <button @click="carrito=[]" x-show="carrito.length>0" class="text-[10px] font-bold uppercase text-primary hover:text-white transition-colors">Vaciar</button>
            </div>

            <div x-show="carrito.length===0" class="flex flex-col items-center justify-center p-8 h-48 text-muted text-center text-sm">
              <svg class="w-8 h-8 mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
              El carrito está vacío.<br>Seleccione un producto.
            </div>

            <div class="divide-y divide-white/5">
              <template x-for="(item, index) in carrito" :key="index">
                <div class="p-4 hover:bg-white/5 transition-colors">
                  <div class="flex justify-between mb-2">
                    <p class="text-sm font-bold text-white flex-1 pr-2" x-text="item.nombre"></p>
                    <button @click="carrito.splice(index,1)" class="text-muted hover:text-primary transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                  </div>
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1 bg-base rounded-lg border border-border-light p-1">
                      <button @click="if(item.cantidad>1) item.cantidad--" class="w-7 h-7 flex items-center justify-center text-white hover:bg-white/10 rounded transition-colors font-bold">-</button>
                      <input type="number" x-model.number="item.cantidad" class="w-10 text-center bg-transparent border-none p-0 text-sm font-bold" min="1">
                      <button @click="item.cantidad++" class="w-7 h-7 flex items-center justify-center text-white hover:bg-white/10 rounded transition-colors font-bold">+</button>
                    </div>
                    <p class="font-display font-bold text-lg text-white" x-text="'S/ '+(item.precio*item.cantidad).toFixed(2)"></p>
                  </div>
                </div>
              </template>
            </div>
          </div>

          <!-- Totals -->
          <div class="p-5 bg-card border-t border-border-light flex-shrink-0">
            <div class="space-y-2 mb-4">
              <div class="flex justify-between text-sm text-muted">
                <span>Subtotal</span>
                <span class="font-display text-white" x-text="'S/ '+(totalCarrito()/1.18).toFixed(2)"></span>
              </div>
              <div class="flex justify-between text-sm text-muted">
                <span>IGV (18%)</span>
                <span class="font-display text-white" x-text="'S/ '+(totalCarrito()-totalCarrito()/1.18).toFixed(2)"></span>
              </div>
              <div class="flex justify-between items-end pt-3 border-t border-white/10">
                <span class="text-[10px] font-bold uppercase text-muted">Total</span>
                <span class="text-2xl font-display font-bold text-success" x-text="'S/ '+totalCarrito().toFixed(2)"></span>
              </div>
            </div>
            <div class="grid grid-cols-2 gap-3 mb-4">
              <div>
                <label class="text-[10px] text-muted uppercase tracking-widest block mb-1 font-bold">Comprobante</label>
                <select x-model="posTipoComprobante" class="w-full text-sm">
                  <option value="Boleta">Boleta</option>
                  <option value="Factura">Factura</option>
                  <option value="Ticket">Ticket</option>
                </select>
              </div>
              <div>
                <label class="text-[10px] text-muted uppercase tracking-widest block mb-1 font-bold">Medio de Pago</label>
                <select x-model="posMedioPago" class="w-full text-sm">
                  <option value="Efectivo">Efectivo 💵</option>
                  <option value="Yape/Plin">Yape/Plin 📱</option>
                  <option value="Tarjeta">Tarjeta 💳</option>
                  <option value="Transferencia">Transferencia 🏦</option>
                </select>
              </div>
            </div>
            <button class="w-full py-3.5 rounded-xl text-sm font-bold uppercase tracking-wide transition-all flex items-center justify-center gap-2"
              :disabled="carrito.length===0"
              :class="carrito.length===0?'bg-base border border-border-light text-muted cursor-not-allowed':'bg-primary hover:bg-primary/90 text-white shadow-[0_0_20px_rgba(255,42,77,0.4)] border border-primary/50'"
              @click="procesarVenta()">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
              COBRAR E IMPRIMIR
            </button>
          </div>
        </div>
      </div>

      


    </div><!-- /content -->
</div><!-- /main -->
</div><!-- /app -->

<!-- Modal: Cliente -->
<div x-show="modalCliente" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm" style="display:none;" @keydown.escape.window="modalCliente=false">
  <div class="bg-card rounded-2xl border border-border-light w-full max-w-2xl p-8 shadow-2xl relative">
    <h3 class="title font-bold text-xl text-white mb-6" x-text="editCliente?'Editar Cliente':'Nuevo Cliente'"></h3>
    <div class="grid grid-cols-2 gap-4 mb-6">
      <div class="col-span-2"><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Razón Social *</label><input x-model="formC.razon" placeholder="Nombre completo o empresa"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Tipo Doc</label><select x-model="formC.tipoDoc"><option>DNI</option><option>RUC</option><option>CE</option></select></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Nro. Documento *</label><input x-model="formC.nroDoc" placeholder="00000000"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Teléfono</label><input x-model="formC.telefono" placeholder="999 999 999"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Email</label><input x-model="formC.email" placeholder="correo@ejemplo.com"></div>
      <div class="col-span-2"><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Dirección</label><input x-model="formC.direccion" placeholder="Av. Principal 123"></div>
    </div>
    <div class="flex gap-3 justify-end">
      <button class="btn-ghost" @click="modalCliente=false">Cancelar</button>
      <button class="btn-primary" @click="guardarCliente()">Guardar Cliente</button>
    </div>
  </div>
</div>

<!-- Modal: Producto -->
<div x-show="modalInv" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm" style="display:none;" @keydown.escape.window="modalInv=false">
  <div class="bg-card rounded-2xl border border-border-light w-full max-w-2xl p-8 shadow-2xl">
    <h3 class="title font-bold text-xl text-white mb-6" x-text="editInv?'Editar Producto':'Nuevo Producto'"></h3>
    <div class="grid grid-cols-2 gap-4 mb-6">
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Código *</label><input x-model="formI.codigo" placeholder="AUT-001"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Nombre *</label><input x-model="formI.nombre" placeholder="Nombre del producto"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Categoría</label><input x-model="formI.categoria" list="cats" placeholder="Lubricantes"><datalist id="cats"><option>Motor</option><option>Lubricantes</option><option>Frenos</option><option>Eléctrico</option><option>Suspensión</option><option>Llantas</option><option>Herramientas</option></datalist></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Marca</label><input x-model="formI.marca" placeholder="Castrol, Bosch..."></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Precio Público (S/)</label><input type="number" x-model="formI.precio1" step="0.01" placeholder="0.00"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Precio Mayorista (S/)</label><input type="number" x-model="formI.precio2" step="0.01" placeholder="0.00"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Stock Actual</label><input type="number" x-model="formI.stock" placeholder="0"></div>
      <div><label class="text-[10px] uppercase text-muted mb-1 block font-bold tracking-widest">Stock Mínimo (alerta)</label><input type="number" x-model="formI.stockMin" placeholder="5"></div>
    </div>
    <div class="flex gap-3 justify-end">
      <button class="btn-ghost" @click="modalInv=false">Cancelar</button>
      <button class="btn-primary" @click="guardarProducto()">Guardar Producto</button>
    </div>
  </div>
</div>

<!-- Toast -->
<div x-show="showToast" x-transition class="fixed bottom-6 right-6 z-[1000] py-3 px-5 rounded-xl bg-surface/90 backdrop-blur-xl border border-border-light flex items-center gap-3 shadow-2xl" style="display:none;">
  <div class="w-2.5 h-2.5 rounded-full" :class="toastTipo==='error'?'bg-primary':'bg-success'"></div>
  <span class="font-bold text-white text-sm" x-text="toastMsg"></span>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
/* ── CHART ── */
const ctx = document.getElementById('mainChart').getContext('2d');
const datasets = {
    hoy: {labels:['8h','9h','10h','11h','12h','13h','14h','15h','16h','17h','18h'],data:[0,0,0,0,0,0,0,0,0,0,0]},
    sem: {labels:['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'],data:[320,480,290,510,720,410,0]},
    mes: {labels:Array.from({length:19},(_,i)=>i+1+''),data:[800,1200,950,1400,600,1100,1350,900,1600,1200,800,1450,1100,950,1300,1600,1200,1050,0]},
};
const grad = ctx.createLinearGradient(0,0,0,80);
grad.addColorStop(0,'rgba(240,52,26,0.18)');
grad.addColorStop(1,'rgba(240,52,26,0)');

let chart = new Chart(ctx,{
    type:'line',
    data:{
        labels:datasets.hoy.labels,
        datasets:[{
            data:datasets.hoy.data,
            borderColor:'var(--red)',
            borderWidth:1.5,
            backgroundColor:grad,
            fill:true,
            tension:0.4,
            pointRadius:0,
            pointHoverRadius:4,
            pointHoverBackgroundColor:'var(--red)',
        }]
    },
    options:{
        responsive:true,maintainAspectRatio:false,
        plugins:{legend:{display:false},tooltip:{
            backgroundColor:'#1e1e24',
            borderColor:'rgba(255,255,255,0.08)',borderWidth:1,
            titleColor:'#9898a6',bodyColor:'#f5f5f6',
            titleFont:{size:11,family:"'Cabinet Grotesk',sans-serif"},
            bodyFont:{size:13,weight:'700',family:"'Geist Mono',monospace"},
            padding:10,callbacks:{label:c=>'S/ '+c.parsed.y.toFixed(2)},
        }},
        scales:{
            x:{grid:{display:false},ticks:{color:'#52525f',font:{size:10,family:"'Cabinet Grotesk',sans-serif"},maxRotation:0}},
            y:{display:false,grid:{display:false}},
        },
    }
});

function setChartTab(el,t){
    document.querySelectorAll('.chart-tab').forEach(b=>b.classList.remove('active'));
    el.classList.add('active');
    chart.data.labels = datasets[t].labels;
    chart.data.datasets[0].data = datasets[t].data;
    chart.update('active');
}

/* ── MODALS ── */
function openModal(id){
    document.getElementById(id).classList.add('show');
    if(id==='modalStock') loadProductosSelect();
}
function closeModal(id){
    document.getElementById(id).classList.remove('show');
    const msg = document.querySelector('#'+id+' .sb-modal-msg');
    if(msg){msg.className='sb-modal-msg';msg.textContent='';}
}
document.querySelectorAll('.sb-modal-overlay').forEach(o=>{
    o.addEventListener('click',e=>{if(e.target===o) closeModal(o.id);});
});

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

async function saveProducto(e){
    e.preventDefault();
    const form = e.target;
    const data = Object.fromEntries(new FormData(form));
    const msg = document.getElementById('msgProducto');
    try{
        const r = await fetch('/api/inventario',{
            method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken},
            body:JSON.stringify(data)
        });
        if(!r.ok) throw new Error('Error');
        msg.className='sb-modal-msg success';
        msg.textContent='Producto guardado correctamente';
        form.reset();
        setTimeout(()=>location.reload(),1200);
    }catch(err){
        msg.className='sb-modal-msg error';
        msg.textContent='Error al guardar producto';
    }
    return false;
}

async function loadProductosSelect(){
    const sel = document.getElementById('stockProductoSelect');
    if(sel.options.length>1) return;
    try{
        const r = await fetch('/api/inventario');
        const items = await r.json();
        items.forEach(p=>{
            const opt = document.createElement('option');
            opt.value = p.id;
            opt.textContent = p.nombre + ' (Stock: '+p.stock+')';
            sel.appendChild(opt);
        });
    }catch(err){}
}

async function addStock(e){
    e.preventDefault();
    const form = e.target;
    const fd = new FormData(form);
    const prodId = fd.get('producto_id');
    const cant = parseInt(fd.get('cantidad'));
    const msg = document.getElementById('msgStock');
    try{
        const r1 = await fetch('/api/inventario');
        const items = await r1.json();
        const prod = items.find(p=>p.id==prodId);
        if(!prod) throw new Error('No encontrado');
        prod.stock = (prod.stock||0) + cant;
        const r2 = await fetch('/api/inventario',{
            method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken},
            body:JSON.stringify(prod)
        });
        if(!r2.ok) throw new Error('Error');
        msg.className='sb-modal-msg success';
        msg.textContent='Stock actualizado: +'+cant+' unidades';
        form.reset();
        setTimeout(()=>location.reload(),1200);
    }catch(err){
        msg.className='sb-modal-msg error';
        msg.textContent='Error al actualizar stock';
    }
    return false;
}
</script>
<script>
function app() {
  return {
    page: 'panel',
    csrfToken: '',
    inventario: [],
    clientes: [],
    carrito: [],
    movimientos: [],
    busqInv: '',
    busqCliente: '',
    posBusq: '',
    posCategoria: '',
    posMedioPago: 'Efectivo',
    posTipoComprobante: 'Boleta',
    posClienteId: '',
    modalCliente: false,
    modalInv: false,
    toastMsg: '',
    toastTipo: 'info',
    showToast: false,
    editCliente: null,
    editInv: null,
    formC: { razon:'', comercial:'', tipoDoc:'DNI', nroDoc:'', telefono:'', email:'', direccion:'', distrito:'', ciudad:'', credDias:0, limCredito:0, listaPrecio:'1', estado:'activo', notas:'' },
    formI: { codigo:'', nombre:'', categoria:'Lubricantes', marca:'', unidad:'Unidad', precio1:'', precio2:'', precio3:'', stock:0, stockMin:0, stockMax:0, ubicacion:'', estado:'activo' },
    formM: { tipo:'ingreso', metodo:'Efectivo', concepto:'', monto:'', referencia:'' },

    async init() {
      const meta = document.querySelector('meta[name="csrf-token"]');
      this.csrfToken = meta ? meta.getAttribute('content') : '';
      await this.refreshAll();
    },

    async refreshAll() {
      try {
        const [resC, resI, resM] = await Promise.all([
          fetch('/api/clientes'),
          fetch('/api/inventario'),
          fetch('/api/movimientos')
        ]);
        this.clientes = await resC.json();
        this.inventario = await resI.json();
        this.movimientos = await resM.json();
      } catch(e) {
        this.triggerToast('Error conectando con el servidor', 'error');
      }
    },

    async apiFetch(url, method='GET', data=null) {
      const opts = { method, headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': this.csrfToken, 'Accept':'application/json' } };
      if(data) opts.body = JSON.stringify(data);
      const res = await fetch(url, opts);
      if(!res.ok) throw new Error('API error');
      return await res.json();
    },

    triggerToast(m, t='info') {
      this.toastMsg = m; this.toastTipo = t; this.showToast = true;
      setTimeout(() => this.showToast=false, 3000);
    },

    totalCarrito() {
      return this.carrito.reduce((a, i) => a + (parseFloat(i.precio) * i.cantidad), 0);
    },

    totalVentasHoy() {
      return this.movimientos.filter(m=>m.tipo==='ingreso').reduce((a,m)=>a+parseFloat(m.monto),0);
    },

    saldoCaja() {
      return this.movimientos.reduce((a,m)=>m.tipo==='ingreso'?a+parseFloat(m.monto):a-parseFloat(m.monto),0);
    },

    clientesFiltrados() {
      const b = this.busqCliente.toLowerCase();
      return this.clientes.filter(c=>(c.razon+c.nroDoc+(c.email||'')).toLowerCase().includes(b));
    },

    invFiltrado() {
      const b = this.busqInv.toLowerCase();
      return this.inventario.filter(p=>(p.codigo+p.nombre+(p.categoria||'')).toLowerCase().includes(b));
    },

    abrirEditCliente(c) { this.editCliente=c; this.formC={...c}; this.modalCliente=true; },
    abrirEditInv(p) { this.editInv=p; this.formI={...p}; this.modalInv=true; },

    agregarAlCarrito(producto) {
      const item = this.carrito.find(p=>p.id===producto.id);
      if(item) {
        if(item.cantidad < producto.stock) item.cantidad++;
        else this.triggerToast('Stock insuficiente', 'error');
      } else {
        if(producto.stock>0) this.carrito.push({...producto, cantidad:1, precio:parseFloat(producto.precio1)});
        else this.triggerToast('Sin stock disponible', 'error');
      }
    },

    agregarPorBusqueda() {
      const q = this.posBusq.trim().toLowerCase();
      if(!q) return;
      let p = this.inventario.find(x=>x.codigo.toLowerCase()===q) || this.inventario.find(x=>x.nombre.toLowerCase()===q);
      if(!p) {
        const res = this.inventario.filter(x=>x.nombre.toLowerCase().includes(q)||x.codigo.toLowerCase().includes(q));
        if(res.length===1) p=res[0];
      }
      if(p) { this.agregarAlCarrito(p); this.posBusq=''; }
      else this.triggerToast('Producto no encontrado','error');
    },

    async guardarCliente() {
      if(!this.formC.razon||!this.formC.nroDoc){ alert('Razón Social y Documento son obligatorios'); return; }
      try {
        await this.apiFetch('/api/clientes','POST',this.formC);
        await this.refreshAll();
        this.modalCliente=false;
        this.triggerToast('Cliente guardado');
      } catch(e) { this.triggerToast('Error al guardar','error'); }
    },

    async eliminarCliente(id) {
      if(!confirm('¿Eliminar cliente?')) return;
      try { await this.apiFetch(`/api/clientes/${id}`,'DELETE'); await this.refreshAll(); this.triggerToast('Eliminado'); }
      catch(e) { this.triggerToast('Error','error'); }
    },

    async guardarProducto() {
      if(!this.formI.codigo||!this.formI.nombre){ alert('Código y Nombre son obligatorios'); return; }
      try {
        await this.apiFetch('/api/inventario','POST',this.formI);
        await this.refreshAll();
        this.modalInv=false;
        this.triggerToast('Producto guardado');
      } catch(e) { this.triggerToast('Error al guardar','error'); }
    },

    async eliminarProd(id) {
      if(!confirm('¿Eliminar producto?')) return;
      try { await this.apiFetch(`/api/inventario/${id}`,'DELETE'); await this.refreshAll(); this.triggerToast('Eliminado'); }
      catch(e) { this.triggerToast('Error','error'); }
    },

    async procesarVenta() {
      if(this.carrito.length===0) return;
      const total = this.totalCarrito();
      const rdm = Math.floor(Math.random()*9000)+1000;
      const ref = (this.posTipoComprobante==='Factura'?'F':(this.posTipoComprobante==='Boleta'?'B':'T'))+'001-'+rdm;
      let nombre = 'Cliente Genérico';
      if(this.posClienteId) { const c=this.clientes.find(x=>x.id==this.posClienteId); if(c) nombre=c.razon; }
      const d = new Date();
      const hm = d.getHours().toString().padStart(2,'0')+':'+d.getMinutes().toString().padStart(2,'0');
      const payload = { metodo:this.posMedioPago, concepto:`Venta (${this.posTipoComprobante}) - ${nombre}`, monto:total.toFixed(2), referencia:ref, fecha:d.toLocaleDateString()+' '+hm, carrito:this.carrito };
      try {
        await this.apiFetch('/api/venta','POST',payload);
        await this.refreshAll();
        this.triggerToast('Venta procesada: '+ref);
        this.carrito=[];
        this.posClienteId='';
        setTimeout(()=>alert(`COMPROBANTE GENERADO\n--------------------------\nDocumento: ${ref}\nCliente: ${nombre}\nTotal: S/ ${total.toFixed(2)}\nPago: ${this.posMedioPago}\n\n[Enviado a imprimir...]`),300);
      } catch(e) { this.triggerToast('Error al procesar venta','error'); }
    },

    async guardarMovimiento() {
      if(!this.formM.concepto||!this.formM.monto||parseFloat(this.formM.monto)<=0){ alert('Complete monto y concepto'); return; }
      try {
        const d=new Date(); const hm=d.getHours().toString().padStart(2,'0')+':'+d.getMinutes().toString().padStart(2,'0');
        await this.apiFetch('/api/venta','POST',{...this.formM, fecha:d.toLocaleDateString()+' '+hm, carrito:[]});
        await this.refreshAll();
        this.formM={tipo:this.formM.tipo,metodo:'Efectivo',concepto:'',monto:'',referencia:''};
        this.triggerToast('Movimiento registrado');
      } catch(e) { this.triggerToast('Error','error'); }
    }
  }
}
</script>
</body>
</html>
