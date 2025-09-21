
function DemoFeatures() {
	const [count, setCount] = React.useState(0);
	const [showMsg, setShowMsg] = React.useState(true);
	const [input, setInput] = React.useState('');
	const [items, setItems] = React.useState([]);

	function handleAdd(e) {
		e.preventDefault();
		if (input.trim()) {
			setItems([...items, input]);
			setInput('');
		}
	}

    return (
            <div style={{border: '1px solid #ccc', padding: '1em', marginTop: '1em'}}>
                <h1>Hello, world</h1> {/* Hello World, JSX, Rendering Elements */}
                <p>Count: {count}</p>
                <button onClick={() => setCount(count + 1)}>Increment</button> {/* Handling Events, State */}
                <button onClick={() => setShowMsg(!showMsg)}>
                    {showMsg ? 'Hide' : 'Show'} Message
                </button>
                {showMsg && <p>This is a conditionally rendered message.</p>} {/* Conditional Rendering */}
                <form onSubmit={handleAdd} style={{marginTop: '1em'}}>
                    <input value={input} onChange={e => setInput(e.target.value)} placeholder="Add item" />
                    <button type="submit">Add</button>
                </form>
                <ul>
                    {items.map((item, idx) => (
                            <li key={idx}>{item}</li>
                        /* Lists and Keys */
                    ))}
                </ul>
            </div>
        );
}



// Clock class component with state and lifecycle







function ProductCategoryRow(props) {
    return React.createElement('tr', null,
        React.createElement('th', { colSpan: 2 }, props.category)
    );
}

function ProductRow(props) {
    const name = props.product.stocked ? props.product.name : React.createElement('span', { style: { color: 'red' } }, props.product.name);
    return React.createElement('tr', null,
        React.createElement('td', null, name),
        React.createElement('td', null, props.product.price)
    );
}

function ProductTable(props) {
    const rows = [];
    let lastCategory = null;
    props.products.forEach(function(product) {
        if (product.category !== lastCategory) {
            rows.push(React.createElement(ProductCategoryRow, { category: product.category, key: product.category }));
        }
        rows.push(React.createElement(ProductRow, { product: product, key: product.name }));
        lastCategory = product.category;
    });
    return React.createElement('table', null,
        React.createElement('thead', null,
            React.createElement('tr', null,
                React.createElement('th', null, 'Name'),
                React.createElement('th', null, 'Price')
            )
        ),
        React.createElement('tbody', null, rows)
    );
}

class SearchBar extends React.Component {
    constructor(props) {
        super(props);
        this.handleFilterTextChange = this.handleFilterTextChange.bind(this);
        this.handleInStockChange = this.handleInStockChange.bind(this);
    }
    handleFilterTextChange(e) {
        this.props.onFilterTextChange(e.target.value);
    }
    handleInStockChange(e) {
        this.props.onInStockChange(e.target.checked);
    }
    render() {
        return React.createElement('form', null,
            React.createElement('input', {
                type: 'text',
                placeholder: 'Search...',
                value: this.props.filterText,
                onChange: this.handleFilterTextChange
            }),
            React.createElement('p', null,
                React.createElement('input', {
                    type: 'checkbox',
                    checked: this.props.inStockOnly,
                    onChange: this.handleInStockChange
                }),
                ' ',
                'Only show products in stock'
            )
        );
    }
}

class FilterableProductTable extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            filterText: '',
            inStockOnly: false
        };
        this.handleFilterTextChange = this.handleFilterTextChange.bind(this);
        this.handleInStockChange = this.handleInStockChange.bind(this);
    }
    handleFilterTextChange(filterText) {
        this.setState({ filterText: filterText });
    }
    handleInStockChange(inStockOnly) {
        this.setState({ inStockOnly: inStockOnly });
    }
    render() {
        return React.createElement('div', null,
            React.createElement(SearchBar, {
                filterText: this.state.filterText,
                inStockOnly: this.state.inStockOnly,
                onFilterTextChange: this.handleFilterTextChange,
                onInStockChange: this.handleInStockChange
            }),
            React.createElement(ProductTable, {
                products: this.props.products.filter(product => {
                    const nameMatch = product.name.toLowerCase().includes(this.state.filterText.toLowerCase());
                    const stockMatch = !this.state.inStockOnly || product.stocked;
                    return nameMatch && stockMatch;
                })
            })
        );
    }
}

const PRODUCTS = [
    {category: 'Sporting Goods', price: '$49.99', stocked: true, name: 'Football'},
    {category: 'Sporting Goods', price: '$9.99', stocked: true, name: 'Baseball'},
    {category: 'Sporting Goods', price: '$29.99', stocked: false, name: 'Basketball'},
    {category: 'Electronics', price: '$99.99', stocked: true, name: 'iPod Touch'},
    {category: 'Electronics', price: '$399.99', stocked: false, name: 'iPhone 5'},
    {category: 'Electronics', price: '$199.99', stocked: true, name: 'Nexus 7'}
];

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(React.createElement(FilterableProductTable, { products: PRODUCTS }));
