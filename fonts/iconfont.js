(function(window){var svgSprite='<svg><symbol id="icon-download" viewBox="0 0 1024 1024"><path d="M512 992l480-480h-288V0H320v512H32z"  ></path></symbol><symbol id="icon-copy" viewBox="0 0 1024 1024"><path d="M640 256V0H192L0 192v576h384v256h640V256H640zM192 90.496V192H90.496L192 90.496zM64 704V256h192V64h320v192l-192 192v256H64z m512-357.504V448h-101.504L576 346.496zM960 960H448V512h192v-192h320v640z"  ></path></symbol><symbol id="icon-user" viewBox="0 0 1024 1024"><path d="M576 706.624v-52.768c70.496-39.712 128-138.784 128-237.824 0-159.072 0-288-192-288s-192 128.928-192 288c0 99.072 57.504 198.112 128 237.824v52.768C230.912 724.384 64 831.04 64 960h896c0-128.96-166.912-235.648-384-253.376z"  ></path></symbol><symbol id="icon-logo" viewBox="0 0 1344 1024"><path d="M1086.656 415.424C1072.896 203.904 925.792 0 656 0c-32.928 0-65.408 3.2-96.576 9.504a16 16 0 0 0 6.368 31.392A452.992 452.992 0 0 1 656 32C930.816 32 1056 247.648 1056 448v48a16 16 0 0 0 32 0V448l-0.032-0.512C1185.984 455.936 1312 541.312 1312 720c0 152.544-112.448 272-256 272H288c-127.232 0-256-93.44-256-272C32 588.992 112.128 448 288 448h48a16 16 0 0 0 0-32H288v-64c0-119.264 73.568-193.344 192-193.344 107.648 0 192 84.928 192 193.344v415.776l-133.12-123.52a15.968 15.968 0 1 0-21.76 23.424l144.512 134.048c9.568 9.536 18.016 14.24 26.464 14.24 8.352 0 16.64-4.64 25.856-13.856l144.928-134.464a15.936 15.936 0 0 0 0.832-22.592 15.904 15.904 0 0 0-22.592-0.832L704 767.776V352c0-126.368-98.4-225.344-224-225.344-136.064 0-224 88.448-224 225.344v65.632c-168.16 16.256-256 160.096-256 302.368C0 867.36 100.928 1024 288 1024h768c161.504 0 288-133.536 288-304 0-201.728-145.824-296.896-257.344-304.576z"  ></path></symbol><symbol id="icon-edit" viewBox="0 0 1024 1024"><path d="M507.428571 676.571429l66.304-66.304-86.857142-86.857143-66.304 66.304V621.714286H475.428571v54.857143h32zM758.857143 265.142857c-5.156571-5.156571-13.714286-4.571429-18.870857 0.585143l-200.009143 200.009143c-5.156571 5.156571-5.705143 13.714286-0.585143 18.870857s13.714286 4.571429 18.870857-0.585143l200.009143-200.009143c5.156571-5.156571 5.705143-13.714286 0.585143-18.870857zM804.571429 604.562286V713.142857c0 90.843429-73.728 164.571429-164.571429 164.571429h-475.428571A164.644571 164.644571 0 0 1 0 713.142857v-475.428571C0 146.870857 73.728 73.142857 164.571429 73.142857h475.428571c22.857143 0 45.714286 4.571429 66.852571 14.299429 5.156571 2.304 9.142857 7.424 10.276572 13.129143a17.956571 17.956571 0 0 1-5.156572 16.566857l-28.013714 28.013714a17.225143 17.225143 0 0 1-18.285714 4.571429A98.633143 98.633143 0 0 0 639.963429 146.285714h-475.428572a91.684571 91.684571 0 0 0-91.428571 91.428572v475.428571c0 50.285714 41.142857 91.428571 91.428571 91.428572h475.428572c50.285714 0 91.428571-41.142857 91.428571-91.428572v-72.009143c0-4.571429 1.718857-9.142857 5.156571-12.580571l36.571429-36.571429c5.705143-5.705143 13.129143-6.838857 20.004571-3.986285s11.446857 9.142857 11.446858 16.566857zM749.714286 182.857143L914.285714 347.428571 530.285714 731.428571H365.714286v-164.571428z m253.732571 75.446857L950.893714 310.857143l-164.571428-164.571429 52.553143-52.553143a55.552 55.552 0 0 1 77.714285 0l86.857143 86.857143a55.552 55.552 0 0 1 0 77.714286z"  ></path></symbol><symbol id="icon-search" viewBox="0 0 1024 1024"><path d="M621.664 653.664a272 272 0 1 1 64-64l178.72 178.72c17.6 17.6 17.472 45.792 0 63.232l-0.736 0.736a44.736 44.736 0 0 1-63.232 0l-178.72-178.72zM464 640a208 208 0 1 0 0-416 208 208 0 0 0 0 416z"  ></path></symbol><symbol id="icon-key" viewBox="0 0 1024 1024"><path d="M704 0c-176.736 0-320 143.264-320 320 0 20.032 1.856 39.616 5.376 58.624L0 768v192a64 64 0 0 0 64 64h64v-64h128v-128h128v-128h128l83.04-83.04A319.264 319.264 0 0 0 704 640c176.736 0 320-143.264 320-320S880.736 0 704 0z m95.872 320.128a96 96 0 1 1 0-192 96 96 0 0 1 0 192z"  ></path></symbol><symbol id="icon-close" viewBox="0 0 1024 1024"><path d="M809.984 274.005333L571.989333 512l237.994667 237.994667-59.989333 59.989333L512 571.989333l-237.994667 237.994667-59.989333-59.989333L452.010667 512 214.016 274.005333l59.989333-59.989333L512 452.010667l237.994667-237.994667z"  ></path></symbol><symbol id="icon-xunlei" viewBox="0 0 1024 1024"><path d="M861.658 109.937c-57.586 23.637-132.32 60.945-195.812 97.792-78.903 45.766-155.027 97.208-219.563 148.422l-12.745 10.08-2.318-2.783c-1.273-1.621-5.328-6.953-8.919-11.933-32.792-45.189-78.906-76.472-123.511-84.002-19.235-3.13-47.043-0.348-67.434 6.953-9.732 3.359-10.66 3.475-102.656 10.428-50.982 3.939-93.966 7.065-95.471 7.065-5.796 0-0.58 1.393 22.128 5.909 57.355 11.24 89.447 19.35 118.068 29.778 17.377 6.257 49.589 19.698 50.285 20.971 1.273 2.086-7.07 66.854-11.008 85.856-1.277 6.024-2.898 13.906-3.707 17.38-0.696 3.475-1.277 15.989-1.393 27.81 0 17.84 0.465 23.633 2.666 34.412 8.342 41.595 28.734 77.626 63.495 112.156 20.391 20.275 40.434 35.57 90.259 68.478 28.269 18.766 46.227 29.658 79.827 48.548 13.326 7.414 27.693 15.64 31.864 18.305 31.4 19.699 56.658 42.06 126.525 112.04 37.308 37.54 50.402 49.94 49.934 47.62-1.621-9.62-12.626-64.073-16.568-81.801-16.453-74.5-35.342-139.387-49.937-171.48-3.13-7.065-6.49-14.366-7.305-16.22l-1.502-3.478 30.82 0.464c25.954 0.349 76.24-1.505 77.741-2.778 0.116-0.232-1.273-5.448-3.355-11.588-2.086-6.14-3.478-11.353-3.246-11.705 0.351-0.228 8.806 3.479 19.002 8.343l18.418 8.686 33.601-9.495c18.422-5.216 34.065-9.739 34.645-10.08 0.465-0.229-2.433-3.942-6.485-8.226-4.055-4.171-9.619-10.196-12.513-13.21-6.028-6.485-7.882-6.953 20.62 4.98l20.046 8.343 22.829-8.343c12.513-4.628 23.285-8.687 23.866-9.031s-4.288-5.68-11.012-11.937l-12.049-11.353 20.507 6.837 20.627 6.721 54.112-19.347c29.89-10.66 57.119-20.398 60.597-21.551 3.474-1.048 6.72-2.434 7.3-2.782 1.274-1.273-56.193-26.529-107.294-47.155-58.853-23.754-144.25-54.34-179.24-64.192-7.302-1.969-13.787-4.055-14.255-4.515-0.46-0.58 12.165-19.234 28.153-41.711 15.876-22.48 28.973-41.018 28.973-41.134 0-0.232-3.598-0.81-8.117-1.157-4.397-0.465-8.11-1.161-8.11-1.51 0-0.344 17.268-25.37 38.352-55.497s38.468-55.152 38.584-55.73c0-0.463-3.71-1.276-8.342-1.74-4.632-0.345-8.687-0.925-8.92-1.157-0.467-0.464 8.92-13.558 60.482-84.234 15.527-21.204 28.156-38.813 27.928-38.93-0.232-0.238-8.926 3.12-19.467 7.408z"  ></path></symbol><symbol id="icon-share" viewBox="0 0 1024 1024"><path d="M1024 365.714q0 14.857-10.857 25.715L720.57 684q-10.857 10.857-25.714 10.857T669.143 684t-10.857-25.714V512h-128q-56 0-100.286 3.429t-88 12.285T266 552t-60.286 39.714T160 649.43t-27.714 79.142-10 103.429q0 31.429 2.857 70.286 0 3.428 1.428 13.428T128 930.857q0 8.572-4.857 14.286t-13.429 5.714q-9.143 0-16-9.714-4-5.143-7.428-12.572T78.57 911.43t-6-13.715Q0 734.857 0 640q0-113.714 30.286-190.286 92.571-230.285 500-230.285h128V73.143q0-14.857 10.857-25.714t25.714-10.858 25.714 10.858L1013.143 340Q1024 350.857 1024 365.714z"  ></path></symbol></svg>';var script=function(){var scripts=document.getElementsByTagName("script");return scripts[scripts.length-1]}();var shouldInjectCss=script.getAttribute("data-injectcss");var ready=function(fn){if(document.addEventListener){if(~["complete","loaded","interactive"].indexOf(document.readyState)){setTimeout(fn,0)}else{var loadFn=function(){document.removeEventListener("DOMContentLoaded",loadFn,false);fn()};document.addEventListener("DOMContentLoaded",loadFn,false)}}else if(document.attachEvent){IEContentLoaded(window,fn)}function IEContentLoaded(w,fn){var d=w.document,done=false,init=function(){if(!done){done=true;fn()}};var polling=function(){try{d.documentElement.doScroll("left")}catch(e){setTimeout(polling,50);return}init()};polling();d.onreadystatechange=function(){if(d.readyState=="complete"){d.onreadystatechange=null;init()}}}};var before=function(el,target){target.parentNode.insertBefore(el,target)};var prepend=function(el,target){if(target.firstChild){before(el,target.firstChild)}else{target.appendChild(el)}};function appendSvg(){var div,svg;div=document.createElement("div");div.innerHTML=svgSprite;svgSprite=null;svg=div.getElementsByTagName("svg")[0];if(svg){svg.setAttribute("aria-hidden","true");svg.style.position="absolute";svg.style.width=0;svg.style.height=0;svg.style.overflow="hidden";prepend(svg,document.body)}}if(shouldInjectCss&&!window.__iconfont__svg__cssinject__){window.__iconfont__svg__cssinject__=true;try{document.write("<style>.svgfont {display: inline-block;width: 1em;height: 1em;fill: currentColor;vertical-align: -0.1em;font-size:16px;}</style>")}catch(e){console&&console.log(e)}}ready(appendSvg)})(window)