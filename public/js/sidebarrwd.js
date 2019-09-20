{ 
// no need to code up anything once this stuff below runs
// you can just use the custom elements as they appear in the html
// prolly needs some docs but eh it works.
const {component, dom: {div}, isStr, isObj, merge, $} = rilti

const toggleAbleOpenAttr = (config = {}, toggler = div.toggler()) => merge(config, {
  methods: {
    toggle (el, open = !el.open) {
      const event = new CustomEvent('toggle', {detail: {open}})
      el.open = event.open = open
      el.dispatchEvent(event)
    }
  },
  props: {
    toggler: el => {
      isStr(toggler) ? toggler = el.findOne(toggler) : el.append(toggler)
      toggler.on.click(e => el.toggle())
      return toggler
    },
    accessors: {
      open: {
        get: el => el.attr.has('open'),
        set: (el, open) => el.attrToggle('open', !!open)
      }
    }
  }
})

component('side-bar', toggleAbleOpenAttr({
  props: {
    accessors: {
      selected: {
        get (sb) {
          const selected = sb.state.selected || sb.findOne('sb-item.selected')
          if (selected) return $(selected)
        },
        set (sb, selected) {
          selected = $(selected)
          if (selected.class.selected) return
          selected.class.selected = true
          if (sb.selected) {
            (sb.selectedLast = sb.selected).class.selected = false
          }
          sb.state.selected = selected
        }
      }
    }
  },
  mount (el) {
    el.on.click(({target}) => {
      if (target === el || target === el()) return
      if ((target = $(target)).matches('sb-item') && !target.class.selected) {
        el.selected = target
      }
    })
  }
}))

component('sb-menu', toggleAbleOpenAttr({}, 'sb-menu-title'))
}

$('.c-l').click(function(){
  if(!$('.collapse').hasClass('in')){
    $('.c-l .float-right').text('-');  
  } else {
    $('.c-l .float-right').text('+');  
  }
});

$('.c-2').click(function(){
  if(!$('.collapse').hasClass('in')){
    $('.c-2 .float-right').text('-');  
  } else {
    $('.c-2 .float-right').text('+');  
  }
});