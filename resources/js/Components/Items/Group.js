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

  static getDerivedStateFromProps(props, state) {
    if (props.items !== state.items) {
      return {
        items: props.items,
      };
    }

    return null;
  }

  render() {
    return (
      <div>
        <div className="x-pt-2 x-pb-1 x-px-4 x-text-sm x-font-semibold">
          asdasd
        </div>
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

            return <Item
              selected={this.props.checkSelectedItem(item)}
              select={this.props.select}
              item={item}
            />;
          })}
        </div>
      </div>
    );
  }
}