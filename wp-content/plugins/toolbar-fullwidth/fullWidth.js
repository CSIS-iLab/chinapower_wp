(function (wp) {
  const fullWidthShortcode = function (props) {
    return wp.element.createElement(
      wp.editor.RichTextToolbarButton, {
        icon: '',
        title: 'FullWidth',
        onClick: function () {
          props.onChange(wp.richText.insert(
            props.value,
            valueToInsert = '[fullWidth width=""][/fullWidth]',
            startIndex = props.value.start,
            endIndex = props.value.end
          ))
        }
      }
    )
  }
  wp.richText.registerFormatType(
    'full-width/sample-output', {
      title: 'FullWidth Shortcode',
      tagName: 'fullwidth',
      className: null,
      edit: fullWidthShortcode
    }
  )
})(window.wp)
