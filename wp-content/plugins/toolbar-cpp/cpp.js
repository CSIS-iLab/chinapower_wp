(function (wp) {
  const cppShortcode = function (props) {
    return wp.element.createElement(
      wp.editor.RichTextToolbarButton, {
        icon: '',
        title: 'CPP',
        onClick: function () {
          props.onChange(wp.richText.insert(
            props.value,
            valueToInsert = '[cpp]',
            startIndex = props.value.start,
            endIndex = props.value.end
          ))
        }
      }
    )
  }
  wp.richText.registerFormatType(
    'cpp/sample-output', {
      title: 'CPP Shortcode',
      tagName: 'div',
      className: null,
      edit: cppShortcode
    }
  )
})(window.wp)
