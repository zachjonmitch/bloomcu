# Theming the BloomCU Design Base Theme

## Namespacing

> There are only two hard things in Computer Science: cache invalidation and naming things.
> — Phil Karlton

Class names should follow namespacing rules.

| TYPE | PREFIX | EXAMPLE | DESCRIPTION |
|------|-------|---------|--------------|
| Component | `c-` | `c-card` | Standalone Element or Component |
| Layout    | `l-` |  `l-grid`| These blocks have no cosmetics and are used to position `c-` components |
| JavaScript | `js-` | `js-tab` | Indicate that JavaScript behavior is attached to a component. No style should be associated with these; they are purely used to enable easier manipulation with JavaScript.|
| States | `is-` `has-` | `is-active` | Indicate different states that a `c-` component can have. These should never have a global style |
| Helper | `h-` | `h-visual-hide` | These utility classes have a single function, (Commonly used for positioning or visibility.) |
| Link | `link-` | `link-services` | Indicates an ID used for `href` targeted linking, no styling should be attached to these. |

Learn more about CSS class [namespacing](https://csswizardry.com/2015/03/more-transparent-ui-code-with-namespaces/).

### State Hooks 

- `is-active`
- `is-visible`
- `is-disabled`
- `is-collapsed`
- `is-expanded`
- `has-loaded`

Learn more about [state hooks](https://github.com/chris-pearce/css-guidelines#state-hooks).

## BEM

We Follow the [BEM](https://en.bem.info/methodology/quick-start/) methodology. 

BEM (Block, Element, Modifier) helps us structure our CSS in a way that will keep our code lightweight and DRY.

__Here's the basics__

![003-cube](https://user-images.githubusercontent.com/18709288/31796821-84d1f046-b4e8-11e7-857d-8485a6d25fd2.png)
### Block
> Standalone entity that is meaniful on it's own.

This block could be placed anywhere in the application and maintain it's styling.

Some Examples are the `header`, `footer`, `blog-post-card`.
Use namespacing to show the purpose of the block. So `l-grid` can be used to wrap any group of elements.

```
.l-grid {
  display: flex;
  max-width: 1280px;
  margin: 0 auto;
}
```
***

![002-cube-1](https://user-images.githubusercontent.com/18709288/31796811-81927676-b4e8-11e7-9694-15a7f07f9474.png)
### Elements
> A part of a block that has no standalone meaning and is semantically tied to its block.

In our example, the `l-grid` has elements that are only used within `l-grid`. The double underscore indicates an element `l-grid__item`
```
.l-grid {
  display: flex;
  max-width: 1280px;
  margin: 0 auto;
  
  .l-grid__item {
    width: 100%;
    padding: 10px;
  }
}
```

Double-underscore pattern should appear only once in a selector name. Don't nest elements in selector names `l-grid__item__title`.

> BEM naming isn’t strictly tied to the DOM, so it doesn’t matter how many levels deep a descendant element is nested. The naming convention is there to help you identify relationships with the top-level component block — in this case, c-card.

In the following example we use `c-card__title` not `c-card__header__title`.

```
<div class="c-card">
    <div class="c-card__header">
        <h2 class="c-card__title">Title text here</h2>
    </div>

    <div class="c-card__body">

        <img class="c-card__img" src="some-img.png" alt="description">
        <p class="c-card__text">Lorem ipsum dolor sit amet, consectetur</p>
        <p class="c-card__text">Adipiscing elit.
            <a href="/somelink.html" class="c-card__link">Pellentesque amet</a>
        </p>

    </div>
</div>
```
***

![001-spray](https://user-images.githubusercontent.com/18709288/31796808-7fcc1c34-b4e8-11e7-9176-0e96577931c2.png)
### Modifier
> A flag on a block or element. Use them to change appearance or behavior.

Examples of this can be `primary-color` or `fixed`. Modifiers are denoted by `--<modifier>`

In our example let's say that some of our `l-grid__item`s need to be 50% wide. This is a perfect case for a modifier. `l-grid__item--half`
```
.l-grid {
  display: flex;
  max-width: 1280px;
  margin: 0 auto;
  
  .l-grid__item {
    width: 100%;
    padding: 10px;
    
    .l-grid__item--half {
      width: 50%;
    }
  }
}
```

Review an [example](https://medium.com/@mjtweaver/css-architecture-bemcss-block-element-modifier-e642bd0f4218) of refactoring to BEM.

***
## Resources
[Battling BEM CSS: 10 Common Problems And How To Avoid Them](https://www.smashingmagazine.com/2016/06/battling-bem-extended-edition-common-problems-and-how-to-avoid-them/)

[Why BEM is G.R.E.A.T](https://blog.elpassion.com/reasons-to-use-bem-a88738317753)

[Does__BEM — work?](https://medium.com/@jackappleby/does-bem-work-945c523116c)

[CSS Guidelines by Chris Pearce](https://github.com/chris-pearce/css-guidelines#state-hooks)

[More Transparent UI Code with Namespaces](https://csswizardry.com/2015/03/more-transparent-ui-code-with-namespaces/)

***
[Icons designed by Smashicons](https://www.flaticon.com/authors/smashicons)
