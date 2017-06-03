import config from '../config'

/**
 * @description Adds smooth scroll to mousewheel scroll event.
 *
 * @export
 * @class SmoothScroll
 */
export class SmoothScroll {
  private travel: number
  /**
   * @description Creates an instance of SmoothScroll.
   * @param {number} [amount]
   *
   * @memberof SmoothScroll
   */
  constructor(amount?: number) {
    this.travel = amount || 100
  }

  /**
   *
   *
   * @private
   * @param {any} e
   *
   * @memberof SmoothScroll
   */
  private doSmoothScroll(e): void {
    let a: number = e.originalEvent.wheelDelta / 360 || -e.originalEvent.detail / 3
    a = $(window).scrollTop() - this.travel * a

    TweenLite.to(
      window,
      0.35,
      {
        scrollTo: {
          y: a,
          autoKill: false
        },
        ease: Power1.easeOut
      }
    )
  }

  /**
   *
   *
   *
   * @memberof SmoothScroll
   */
  public setSmoothScroll(): void {
    $(window).on('mousewheel DOMMouseScroll', (e: JQueryEventObject) => {
      if (!config.KEY && !$('body').hasClass('body-modal')) {
        e.preventDefault()
        this.doSmoothScroll(e)
      }
    })
  }
}
