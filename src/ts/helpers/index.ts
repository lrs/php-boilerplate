export const isEmpty = (str: string): boolean => !str || /^\s*$/.test(str)

export const loadScript = (src: string) => {
  const scriptNode = document.createElement('script')

  scriptNode.async = true
  scriptNode.defer = true
  scriptNode.src = src

  document.body.appendChild(scriptNode)
}

export const inView = (el, offset) => {
  if (el.getBoundingClientRect().top < $(window).innerHeight() - offset && el.getBoundingClientRect().bottom > 0) {
    return true
  }
  return false
}
