// visual effect
const container = document.querySelector('.skills__brands');

let parentX = 0;
let parentY = 0;

//parent move event
container.addEventListener('mousemove', (e) => {
  parentX = e.pageX;
  parentY = e.pageY;
});

// single child element
const childElements = document.querySelectorAll('.skills__brand');
for (const element of childElements) {
  //   const cover = element.querySelector('.brand__cover');

  // child enter event
  element.addEventListener('mouseenter', (e) => {
    const classLength = element.classList;
    for (let i = 3; i <= classLength; i++) {
      const className = element.classList.item(index);
      element.classList.remove(className);
    }

    const cover = element.querySelector('.brand__cover');

    const width = element.clientWidth;
    const height = element.clientHeight;

    const left = element.offsetLeft;
    const right = element.offsetLeft + width;
    const top = element.offsetTop;
    const bottom = element.offsetTop + height;

    if (parentY <= top) {
      // top enter
      enter(cover, 'top-pre', 'top-main');
    } else if (parentY >= top && parentY <= bottom && parentX <= left) {
      // left enter
      enter(cover, 'left-pre', 'left-main');
    } else if (parentY >= top && parentY <= bottom && parentX >= right) {
      // right enter
      enter(cover, 'right-pre', 'right-main');
    } else {
      // bottom enter
      enter(cover, 'bottom-pre', 'bottom-main');
    }
  });

  // child leave event
  element.addEventListener('mouseleave', (e) => {
    const cover = element.querySelector('.brand__cover');

    const width = element.clientWidth;
    const height = element.clientHeight;

    const left = element.offsetLeft;
    const right = element.offsetLeft + width;
    const top = element.offsetTop;
    const bottom = element.offsetTop + height;

    const x = e.pageX;
    const y = e.pageY;

    if (y <= top) {
      leave(cover, 'top-leave');
    } else if (y > top && y < bottom && x <= left) {
      leave(cover, 'left-leave');
    } else if (y > top && y < bottom && x >= right) {
      leave(cover, 'right-leave');
    } else {
      leave(cover, 'bottom-leave');
    }
  });
}

const enter = (cover, pre, main) => {
  if (cover.classList.contains('finish')) {
    cover.classList.remove('finish');
  }
  cover.classList.add(pre);
  setTimeout(() => {
    cover.classList.add(main);
    setTimeout(() => {
      cover.classList.remove(main, pre);
      cover.classList.add('finish');
    }, 350);
  }, 1);
};

const leave = (cover, leave) => {
  cover.classList.add(leave);
  setTimeout(() => {
    cover.classList.remove(leave);
    cover.classList.remove('finish');
  }, 350);
};
