require('./bootstrap')

require('alpinejs')

import ReactDOM from 'react-dom'
import Welcome from './components/example'

ReactDOM.render(<Welcome />, document.querySelector('#react-app'))
