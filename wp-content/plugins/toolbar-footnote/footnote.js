(function (wp) {
  const footnoteShortcode = function (props) {
    return wp.element.createElement(
      wp.editor.RichTextToolbarButton, {
        icon: '',
        title: 'Footnote',
        onClick: function () {
          props.onChange(wp.richText.insert(
            props.value,
            valueToInsert = '[note][/note]',
            startIndex = props.value.start,
            endIndex = props.value.end
          ))
        }
      }
    )
  }
  wp.richText.registerFormatType(
    'footnote/sample-output', {
      title: 'footnote Shortcode',
      tagName: 'footnote',
      className: null,
      edit: footnoteShortcode
    }
  )
})(window.wp)
