## 第十九章 组合模式

### 19.2 组合模式

组合模（Composite),将对象组合成树形结构以表示‘部分-整体’的层次结构。组合模式使得用户对单个对象和组合对象的使用具有一致性。[DP]

结构图如下所示

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305161938798.png)

Component组合中的对象声明接口，在适当情况下，实现所有类共有接口的默认行为。声明一个接口用于访问和管理Component的子部件

```php
abstract class Component {
    /**
    * @var string  
    */
    protected  $name;
    
    public __construct(string $name) 
    {
        $this->name = $name;
    }
    
    public abstract Add(Component $c);
    public abstract Remove(Component $c);
    public abstract Display(int $path);
}
```

Leaf在组合中表示叶节点对，叶子点没有子节点。

```php
class Leaf extends Component {
    public function Add(Component $c) {
        echo '不能加入'."</br>";
    }
    
    public function Remove(Component $c) {
        echo '不能删除'."</br>";
    }
    
    public function Display(int $depth) {
        $outputStr = '';
        for($i = 0; $i < $depth; $i++) {
            $outputStr .= '-';
        }
        
        echo $outputStr.$this->name."</br>";
    }
}
```

Composite定义有枝节点行为，用来存储子部件，在Component接口中实现与子部件有关的操作，比如增加Add和删除Remove。

```php
class Composite extends Component {
    /**
    * @var array 
    */
    private $children;

    public function Add(Component $c) {
        $this->children[] = $c;
    }
    
    public function Remove(Component $c) {
        if (!$this->children) {
            return ;
        }
        $index = array_search($c,$this->children);
        unset($c);
    }
    
    public function Display(int $depth) {
        $outputStr = '';
        for($i = 0; $i < $depth; $i++) {
            $outputStr .= '-';
        }
        
        echo $outputStr.$this->name."</br>";
        
        foreach ($this->children as $val) {
            $val->Display($depth+2);
        }
    }
}
```

客户端代码

```php
// 生成树根root，根上在长出两叶LeafA和LeafB
$root = new Composite('root');
$root->Add(new Left("Left A"));
$root->Add(new Left("Left B"));

// 根上长出分枝Composite X,分枝上也有两叶LeafXA和LeafXB
$comp = new Composite('Composite X');
$comp->Add(new Left("Leaf XA"));
$comp->Add(new Left("Leaf XB"));

$root->Add($comp);

// 在Composite X上再长出分枝Composite XY,分枝上也有两叶LeafXYA和LeafXYB
$comp2 = new Composite('Composite XY');
$comp2->Add(new Left("Leaf XYA"));
$comp2->Add(new Left("Leaf XYB"));
$comp->Add($comp2);

//根部又长出两叶Leaf℃和LeafD,可惜LeafD没长牢，被风吹走了
$root->Add (new Leaf ("Leaf C"));
$leaf = new Leaf ("Leaf D");
$root->Add($leaf);
$root->Remove ($leaf);

// 展示大树的样子
$root->display(1);
```

结果类似如下

```shell
-root
---Leaf A
---Leaf B
---Composite X
-----Leaf XA
-----Leaf XB
-----Composite XY
-------Leaf XYA
-------Leaf XYB
---Leaf C
```

### 19.3 透明方式与安全方式

为什么Leaf类当中也有Add和Remove？这种方式叫做透明方式，也就是说在Component中声明所有用来管理子对象的方法，其中包括Add、Remove等。这样实现Component接口的所有子类都具备了Add和Remove。这样做的好处就是叶节点和枝节点对于外界没有区别，它们具备完全一致的行为接口。但问题也很明显，因为Leaf类本身不具备Add()、Remove()方法的功能，所以实现它是没有意义的

Leaf类当中不用Add和Remove方法，可以吗？当然是可以，那么就需要安全方式，也就是在Component接口中不去声明Add和Remove方法，那么子类的Leaf也就不需要去实现它，而是在Composite声明所有用来管理子类对象的方法，这样做就不会出现刚才提到的问题，不过由于不够透明，所以树叶和树枝类将不具有相同的接口，客户端的调用需要做相应的判断，带来了不便。

### 19.4 何时使用组合模式

什么地方用组合模式比较好呢？当你发现需求中是体现部分与整体层次的结构时，以及你希望用户可以忽略组合对象与单个对象的不同，统一地使用组合结构中的所有对象时，就应该考虑用组合模式了

### 19.5 公司管理系统

看目录代码

### 19.6 组合模式的好处

好处：组合对象的类层次结构。基本对象可以被组合成更复杂的组合对象，而这个组合对象又可以被组合，这样不断地递归下去，客户代码中，任何用到基本对象的地方都可以使用组合对象了。用户是不用关心到底是处理一个叶节点还是处理一个组合组件，也就用不着为定义组合而写一些选择判断语句了。组合模式让客户可以一致地使用组合结构和单个对象