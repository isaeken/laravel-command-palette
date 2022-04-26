import React from 'react';
import Item from "./Item";

export default class Group extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      title: props.title,
      description: props.description,
      items: props.items,
    };
  }

  render() {
    return (
      <div>
        <div>asdasd</div>
        <div>
          {this.state.items.map((item) => {
            if (item.hasOwnProperty('type') && item.type === 'group') {
              let props = {...this.props};
              props.items = item.items;
              return (
                <div className="x-divide-y">
                  <Group {...props} />
                </div>
              );
            }

            return <Item selected={this.props.checkSelectedItem(item)} item={item}/>;
          })}
        </div>
      </div>
    );
  }
}