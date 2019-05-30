for (var i = 0, len = datas.length; i < len; ++i) {
  let source = '.article-rows--column[data-get="' + datas[i] + '"]';
  elms.push(document.querySelectorAll(source));
  for (var s = 0, le = elms.length; s < le; ++s) {
    let e = elms[s];
    for  (var x = 0, l = e.length; x < l; ++x) {
      harray.push(e[x].clientHeight);
    }
  }
  h.push(Math.max.apply(null,harray));
}

for (var i = 0, len = datas.length; i < len; ++i) {
  let source = '.column__cover-more[data-set="' + datas[i] + '"]';
  let e = document.querySelectorAll(source);
  let hh = h[i] - 13;
  e[0].style.height = hh + "px";
}