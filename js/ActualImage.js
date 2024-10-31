var ActualImage = React.createClass({

	getInitialState: function() {
		return { imageFilename: this.props.initialImageFilename }
	},

	refreshImage: function() {

		var xhr = new XMLHttpRequest()
		xhr.open('GET', encodeURI(this.props.ajaxUrl + '?action=last_image&dir=' + this.props.subdir))
		xhr.onload = function() {
			if (xhr.status === 200) {
				this.setState({ imageFilename: xhr.responseText })
			}
		}.bind(this)
		xhr.send()

	},

	componentDidMount: function() {
		this.interval = setInterval(this.refreshImage, this.props.refreshInterval*1000)
	},

	componentWillUnmount: function() {
		clearInterval(this.interval)
	},

	render: function() {
		return (
			React.createElement('img', { src: this.props.imagesRootUrl + this.state.imageFilename })
		)
	}

})

Array.prototype.forEach.call(document.getElementsByClassName('react-webcam'), function(rootElement) {
	React.render(React.createElement(ActualImage, rootElement.dataset), rootElement)
})
